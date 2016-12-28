<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class StudentEducation extends Model {
    
    protected $table = 'students_education';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function student() {
        return $this->belongsTo('App\Student');
    }

}
