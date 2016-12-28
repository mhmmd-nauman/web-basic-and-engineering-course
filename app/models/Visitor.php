<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Visitor extends Model {
    

    protected $table = 'visitors';
    
    public function fish() {
        return $this->hasOne('App\Fish'); 
    }

    public function trees() {
        return $this->hasMany('App\Tree');
    }

    public function picnics() {
        return $this->belongsToMany('App\Picnic', 'bears_picnics', 'bear_id', 'picnic_id');
    }

}
