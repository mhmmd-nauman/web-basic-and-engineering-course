<?php

$algorithm = 'blowfish';
$e = new PasswordEncryptor_Blowfish();

if(!$e->check('$2y$10$02afa11535df310febf1du1lfBBRxRixEGGDJhYxJbk5pDXfb1QfC', '12345678', '10$02afa11535df310febf1d0', null)) {
    echo "comes in if";
} else{
    echo "comes in else";
}
echo $e->encrypt('12345678', '10$02afa11535df310febf1d0', null);
class PasswordEncryptor_Blowfish  {
	/**
	 * Cost of encryption.
	 * Higher costs will increase security, but also increase server load.
	 * If you are using basic auth, you may need to decrease this as encryption
	 * will be run on every request.
	 * The two digit cost parameter is the base-2 logarithm of the iteration
	 * count for the underlying Blowfish-based hashing algorithmeter and must
	 * be in range 04-31, values outside this range will cause crypt() to fail.
	 */
	protected static $cost = 10;

	/**
	 * Sets the cost of the blowfish algorithm.
	 * See {@link PasswordEncryptor_Blowfish::$cost}
	 * Cost is set as an integer but
	 * Ensure that set values are from 4-31
	 *
	 * @param int $cost range 4-31
	 * @return null
	 */
	public static function set_cost($cost) {
		self::$cost = max(min(31, $cost), 4);
	}

	/**
	 * Gets the cost that is set for the blowfish algorithm
	 *
	 * @param int $cost
	 * @return null
	 */
	public static function get_cost() {
		return self::$cost;
	}

	public function encrypt($password, $salt = null, $member = null) {
		// See: http://nz.php.net/security/crypt_blowfish.php
		// There are three version of the algorithm - y, a and x, in order
		// of decreasing security. Attempt to use the strongest version.
		$encryptedPassword = $this->encryptY($password, $salt);
		if(!$encryptedPassword) {
			$encryptedPassword = $this->encryptA($password, $salt);
		}
		if(!$encryptedPassword) {
			$encryptedPassword = $this->encryptX($password, $salt);
		}

		// We *never* want to generate blank passwords. If something
		// goes wrong, throw an exception.
		if(strpos($encryptedPassword, '$2') === false) {
                    echo "Blowfish password encryption failed";
                    //throw new PasswordEncryptor_EncryptionFailed('Blowfish password encryption failed.');
		}

		return $encryptedPassword;
	}

	public function encryptX($password, $salt) {
		$methodAndSalt = '$2x$' . $salt;
		$encryptedPassword = crypt($password, $methodAndSalt);

		if(strpos($encryptedPassword, '$2x$') === 0) {
			return $encryptedPassword;
		}

		// Check if system a is actually x, and if available, use that.
		if($this->checkAEncryptionLevel() == 'x') {
			$methodAndSalt = '$2a$' . $salt;
			$encryptedPassword = crypt($password, $methodAndSalt);

			if(strpos($encryptedPassword, '$2a$') === 0) {
				$encryptedPassword = '$2x$' . substr($encryptedPassword, strlen('$2a$'));
				return $encryptedPassword;
			}
		}

		return false;
	}

	public function encryptY($password, $salt) {
		$methodAndSalt = '$2y$' . $salt;
		$encryptedPassword = crypt($password, $methodAndSalt);

		if(strpos($encryptedPassword, '$2y$') === 0) {
			return $encryptedPassword;
		}

		// Check if system a is actually y, and if available, use that.
		if($this->checkAEncryptionLevel() == 'y') {
			$methodAndSalt = '$2a$' . $salt;
			$encryptedPassword = crypt($password, $methodAndSalt);

			if(strpos($encryptedPassword, '$2a$') === 0) {
				$encryptedPassword = '$2y$' . substr($encryptedPassword, strlen('$2a$'));
				return $encryptedPassword;
			}
		}

		return false;
	}

	public function encryptA($password, $salt) {
		if($this->checkAEncryptionLevel() == 'a') {
			$methodAndSalt = '$2a$' . $salt;
			$encryptedPassword = crypt($password, $methodAndSalt);

			if(strpos($encryptedPassword, '$2a$') === 0) {
				return $encryptedPassword;
			}
		}

		return false;
	}

	/**
	 * The algorithm returned by using '$2a$' is not consistent -
	 * it might be either the correct (y), incorrect (x) or mostly-correct (a)
	 * version, depending on the version of PHP and the operating system,
	 * so we need to test it.
	 */
	public function checkAEncryptionLevel() {
		// Test hashes taken from
		// http://cvsweb.openwall.com/cgi/cvsweb.cgi/~checkout~/Owl/packages/glibc
		//    /crypt_blowfish/wrapper.c?rev=1.9.2.1;content-type=text%2Fplain
		$xOrY = crypt("\xff\xa334\xff\xff\xff\xa3345", '$2a$05$/OK.fbVrR/bpIqNJ5ianF.o./n25XVfn6oAPaUvHe.Csk4zRfsYPi')
			== '$2a$05$/OK.fbVrR/bpIqNJ5ianF.o./n25XVfn6oAPaUvHe.Csk4zRfsYPi';
		$yOrA = crypt("\xa3", '$2a$05$/OK.fbVrR/bpIqNJ5ianF.Sa7shbm4.OzKpvFnX1pQLmQW96oUlCq')
			== '$2a$05$/OK.fbVrR/bpIqNJ5ianF.Sa7shbm4.OzKpvFnX1pQLmQW96oUlCq';

		if($xOrY && $yOrA) {
			return 'y';
		} elseif($xOrY) {
			return 'x';
		} elseif($yOrA) {
			return 'a';
		}

		return 'unknown';
	}

	/**
	 * self::$cost param is forced to be two digits with leading zeroes for ints 4-9
	 */
	public function salt($password, $member = null) {
		$generator = new RandomGenerator();
		return sprintf('%02d', self::$cost) . '$' . substr($generator->randomToken('sha1'), 0, 22);
	}

	public function check($hash, $password, $salt = null, $member = null) {
		if(strpos($hash, '$2y$') === 0) {
			return $hash === $this->encryptY($password, $salt);
		} elseif(strpos($hash, '$2a$') === 0) {
			return $hash === $this->encryptA($password, $salt);
		} elseif(strpos($hash, '$2x$') === 0) {
			return $hash === $this->encryptX($password, $salt);
		}

		return false;
	}
}


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
     <head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">
      
      <title>Send email to me</title>
      <link href='bootstrap/dist/css/bootstrap.css' rel='stylesheet'>
     
      
   </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="background-color: red;">
                    dsds
                </div>
                <div class="col-md-6">
                    dsds
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class = "table">
                        <caption>Basic Table Layout</caption>

                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>City</th>
                           </tr>
                        </thead>

                        <tbody>
                           <tr>
                              <td>Tanmay</td>
                              <td>Bangalore</td>
                           </tr>

                           <tr>
                              <td>Sachin</td>
                              <td>Mumbai</td>
                           </tr>
                        </tbody>

                     </table>
                </div>
            </div>
            <div class="row">
                <form class = "form-horizontal" role = "form">
   
                    <div class = "form-group">
                       <label for = "firstname" class = "col-sm-2 control-label">First Name</label>

                       <div class = "col-sm-10">
                          <input type = "text" class = "form-control" id = "firstname" placeholder = "Enter First Name">
                       </div>
                    </div>

                    <div class = "form-group">
                       <label for = "lastname" class = "col-sm-2 control-label">Last Name</label>

                       <div class = "col-sm-10">
                          <input type = "text" class = "form-control" id = "lastname" placeholder = "Enter Last Name">
                       </div>
                    </div>

                    <div class = "form-group">
                       <div class = "col-sm-offset-2 col-sm-10">
                          <div class = "checkbox">
                             <label><input type = "checkbox"> Remember me</label>
                          </div>
                       </div>
                    </div>

                    <div class = "form-group">
                       <div class = "col-sm-offset-2 col-sm-10">
                          <button type = "submit" class = "btn btn-danger">Sign in</button>
                       </div>
                    </div>

                 </form>
            </div>
            
            
            <h1>Send Email to me</h1>
            <form name="sendemail" id="sendemail" method="post"  action="processfileurl">
                <table  width="50%">
                      <tr>
                          <td>From:</td>
                          <td>
                              <input type="text" name="from" value="" size="50">
                          </td>
                      </tr>
                      <tr>
                          <td>To:</td>
                          <td>
                              <input type="text" name="to" value="" size="50">
                          </td>
                      </tr>
                      <tr>
                          <td>Subject:</td>
                          <td>
                              <input type="text" name="subject" value="" size="50">
                          </td>
                      </tr>
                      <tr>
                          <td>Message:</td>
                          <td>
                                <TEXTAREA name="message" cols="51" rows="6" ></textarea>
                          </td>
                      </tr>
                      <tr>
                          <td>&nbsp;</td>
                          <td>
                                <input type="button" name="testbutton" value="Send email to me">
                          </td>
                      </tr>
                  </table>
                
  
            
              
        </form>
         </div>
    </body>
</html>
