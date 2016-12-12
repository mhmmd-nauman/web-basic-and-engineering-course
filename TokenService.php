<?php

namespace API\v1\Services;

use \Firebase\JWT\JWT;
use \Member;
use \MemberToken;
use \Exception;

/**
 * class TokenService
 * @package Service
 */
class TokenService
{

    /**
     * @var string
     */
    protected static $JWT_KEY = 'w5O4w$Yo(+K4k=g)o-o2OR4K2`5Q#b';

    /**
     * Tests if the token is valid, and returns it if it is
     *
     * @param $jwt
     * @return array|bool
     */
    public static function getToken($jwt)
    {
        if ($jwt) {
            try {
                // decode the jwt using the key from config
                $secretKey = base64_decode(self::$JWT_KEY);

                // Token object
                $token = JWT::decode($jwt, $secretKey, array('HS512'));

                // Verify that the token is still valid
                if ($tokenID = $token->jti) {
                    $tokenObject = MemberToken::get()->filter(array(
                        'TokenID' => $tokenID,
                        'MemberID' => $token->data->MemberID
                    ))->first();

                    // If the token exists and hasn't been revoked
                    if ($tokenObject && !$tokenObject->Revoked) {
                        return $tokenObject;
                    }
                }

            } catch (Exception $e) {
                /*
                 * the token was not able to be decoded.
                 * this is likely because the signature was not able to be verified (tampered token)
                 */
                return false;
            }
        } else {
            // Lacks the token
            return false;
        }


        return false;
    }

    public static function authorizeRequest($request)
    {
        $auth = '';
        if (function_exists('getallheaders')) {
            $headers = getallheaders();

            if (isset($headers['Authorization'])) {
                $auth = $headers['Authorization'];
            }
        }

        if (!$auth) {
            $auth = $request->getHeader('X-Authorization');
        }

        $token = self::getToken($auth);
        return $token;
    }

    /**
     * Generate a token for Member $memberID containing
     * an optional array of data $embeddedData
     *
     * @param $member
     * @return array|bool
     */
    public static function generateToken($member)
    {
        // Member must exist for us to generate a token
        if (!$member || !$member->exists()) {
            return false;
        }

        // The user has been authenticated, prepare the JWT
        $tokenID = base64_encode(mcrypt_create_iv(32, MCRYPT_RAND));
        $issuedAt = time();
        $notBefore = $issuedAt;
        $expire = $notBefore + (60 * 60 * 24 * 365 * 5);
        $serverName = $_SERVER['SERVER_NAME'];

        // Embed data into token
        $embeddedData = array(
            'MemberID' => $member->ID,               // ID to identify the Member object
            'Email' => $member->Email                // Email address of the Member
        );

        /*
         * Create the token as an array
         */
        $data = [
            'iat' => $issuedAt,                     // Issued at time: when the token was generated
            'jti' => $tokenID,                      // Json Token ID: unique identifier for the token
            'iss' => $serverName,                   // Issuer
            'nbf' => $notBefore,                    // Not before
            'exp' => $expire,                    // Expiration timestamp
            'data' => $embeddedData
        ];

//        print_r($data);
//        exit;

        $secretKey = base64_decode(self::$JWT_KEY);

        $jwt = JWT::encode(
            $data,      // Data to be encoded in the JWT
            $secretKey, // The signing key
            'HS512'     // Algorithm used to sign the token
        );

        // Create a database object for the token
        $tokenObject = new MemberToken();
        $tokenObject->UserAgent = $_SERVER['HTTP_USER_AGENT'];
        $tokenObject->IPAddress = $_SERVER['REMOTE_ADDR'];
        $tokenObject->TokenID = $tokenID;
        $tokenObject->MemberID = $member->ID;
        $tokenObject->Issued = $issuedAt;
        $tokenObject->Expires = $expire;
        $tokenObject->write();

        // Revoke tokens which are identical to this one
        $tokenObject->revokeIdenticalTokens();

        return array($jwt, $tokenObject);
    }

    /**
     * Returns an array of consumable user data about a Member
     *
     * @param $member Member
     * @return array
     */
    public static function getUserData($member)
    {
        return [
            'status' => 'OK',
            'id' => $member->ID,
            'email' => $member->Email
        ];
    }

}
