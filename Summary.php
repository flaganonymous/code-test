<?php

namespace testCRm\CrmLauncher\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'summaries';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | Relationships of Contact model
    |
    */

    public function caseOverview()
    {
        return $this->belongsTo('testCRm\CrmLauncher\Models\Case');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
