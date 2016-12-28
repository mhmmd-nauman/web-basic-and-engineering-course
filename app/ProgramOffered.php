<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramOffered extends Model
{
    //
    protected $table = 'programs_offered';
    
    public function department() {
        return $this->belongsTo('App\Department');
    }
    
}
