<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {
    
    protected $table = 'students';
    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function fish() {
        return $this->hasOne('App\Fish','foreign_key', 'local_key'); 
    }
    public function student_program()
    {
        return $this->hasOne('App\ProgramOffered','id','program_id'); 
    }
    public function student_educations() {
        return $this->hasMany('App\StudentEducation');
    }
    
    public function student_pre_major_subjects() {
        return $this->hasMany('App\StudentPreviousMajorSubjects');
    }
    
    public function student_language_ratings() {
        return $this->hasMany('App\StudentLanguageRating');
    }
    
    public function picnics() {
        return $this->belongsToMany('App\Picnic', 'bears_picnics', 'bear_id', 'picnic_id');
    }

}