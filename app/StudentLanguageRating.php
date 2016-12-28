<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class StudentLanguageRating extends Model {
    
    protected $table = 'students_language_ratings';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function student() {
        return $this->belongsTo('App\Student');
    }

}
