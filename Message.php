<?php

namespace testCRm\CrmLauncher\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'messages';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | Relationships of Message model
    |
    */
    public function caseOverview()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\CaseOverview');
    }

    public function answers()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\Answer');
    }

    public function innerAnswers()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\InnerAnswer');
    }

    public function media()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\Media');
    }

    public function contact()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Contact');
    }

    public function innerComment()
    {
        return $this->hasMany('testCRm\CrmLauncher\Models\InnerComment');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | Scopes of Message model
    |
    */
    public function scopelatestMentionId($query)
    {
        return $query->orderBy('tweet_id', 'DESC')->first()->tweet_id;
    }

    public function scopeLatestDirectId($query)
    {
        return $query->where('direct_id', '!=', '')->orderBy('direct_id', 'DESC')->first()->direct_id;
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    |
    | Getters of Message model
    |
    */
    public function getNewestPostDate()
    {
        if (Message::where('fb_post_id', '!=', '')->exists()) {
            return Message::where('fb_post_id', '!=', '')
                ->orderBy('post_date', 'DESC')
                ->first()->post_date;
        }
        return 0;
    }

    public function getNewestMessageDate()
    {
        if (Message::where('fb_private_id', '!=', '')->exists()) {
            return Message::where('fb_private_id', '!=', '')
                ->orderBy('post_date', 'DESC')
                ->first()->post_date;
        }
        return 0;
    }
}
