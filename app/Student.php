<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {
    
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    //protected $fillable = array('name', 'type', 'danger_level');
    protected $table = 'students';
    // DEFINE RELATIONSHIPS --------------------------------------------------
    // each bear HAS one fish to eat
    public function fish() {
        return $this->hasOne('App\Fish'); // this matches the Eloquent model
    }

    // each bear climbs many trees
    public function student_educations() {
        return $this->hasMany('App\StudentEducation');
    }
    
    public function student_pre_major_subjects() {
        return $this->hasMany('App\StudentPreviousMajorSubjects');
    }
    
    public function student_language_ratings() {
        return $this->hasMany('App\StudentLanguageRating');
    }
    
    // each bear BELONGS to many picnic
    // define our pivot table also
    public function picnics() {
        return $this->belongsToMany('App\Picnic', 'bears_picnics', 'bear_id', 'picnic_id');
    }

}
