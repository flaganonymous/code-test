<?php

namespace testCRm\CrmLauncher\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InnerComment extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'inner_comments';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | Relationships of InnerComment model
    |
    */
    public function caseOverview()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\CaseOverview');
    }

    public function answers()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Answer');
    }

    public function innerAnswers()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\InnerAnswer');
    }

    public function media()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\Media', 'inner_comment_id');
    }

    public function contact()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Contact');
    }

    public function message()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Message');
    }

    public function reaction()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Reaction');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    |
    | Scope of InnerComment model
    |
    */

    public function scopeLatestInnerCommentDate($query)
    {
        $messageId = $reactionId = Carbon::today();

        if (InnerComment::where('reaction_id', '0')->exists()) {
            $messageId = InnerComment::orderBy('post_date', 'DESC')->where('reaction_id', '0')->first()->post_date;
        }

        if (InnerComment::where('reaction_id', '!=', '0')->exists()) {
            $reactionId = InnerComment::orderBy('post_date', 'DESC')->where('reaction_id', '!=', '0')->first()->post_date;
        }

        return max($messageId, $reactionId);
    }
}
