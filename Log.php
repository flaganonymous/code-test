<?php

namespace testCRm\CrmLauncher\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'logs';

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | Relationships of Log model
    |
    */

    public function scopeLatestLog($query, $type)
    {
        return $query->where('case_type', $type)->orderBy('id', 'DESC')->first()->created_at;
    }

    public function scopeDashboardUpdate($query)
    {
        return $query->where('case_type', 'dashboard_update');
    }

    /**
     * Updates logs to keep track of API rate limits
     * @param  string $type
     * @return void
     */
    public function updateLog($type)
    {
        $log = new Log();
        if ($type == 'fetching') {
            $log->case_type = "fetching";
        } else if ($type == 'dashboard_update') {
            $log->case_type = "dashboard_update";
        } else if ($type == 'stats') {
            $log->case_type = 'stats';
        } else if ($type == 'publishments') {
            $log->case_type = 'publishments';
        } else if ($type == 'publishment_detail') {
            $log->case_type = 'publishment_detail';
        }

        $log->save();
    }

    /**
     * Check seconds between previous API call & now
     * @return int
     */
    public function secondsago($type)
    {
        if (Log::where('case_type', $type)->exists()) {
            $now = Carbon::now();
            $last = Log::LatestLog($type);
            $lastLog = new Carbon($last);

            return $now->diffInSeconds($lastLog);
        }
        return false;
    }
}
