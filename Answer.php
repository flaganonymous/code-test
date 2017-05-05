<?php

namespace testCRm\CrmLauncher\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Answer extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'answers';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | Relationships of Answer model
    |
    */
    public function message()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Message');
    }

    public function innerComment()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\InnerComment');
    }

    public function innerAnswers()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\InnerAnswer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function caseOverview()
    {
        return $this->belongsTo('App\CaseOverview');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | Scopes of Answer model
    |
    */
    public function scopeTodaysAnswers()
    {
        return Answer::where('post_date', '>=', Carbon::today())->get();
    }
}
