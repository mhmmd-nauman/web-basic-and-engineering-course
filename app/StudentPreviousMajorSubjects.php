<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class StudentPreviousMajorSubjects extends Model {
    
    protected $table = 'students_previous_major_subjects';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function student() {
        return $this->belongsTo('App\Student');
    }

}
