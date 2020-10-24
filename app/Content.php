<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Content extends Model
{
    use HasUuidPrimary, LogsActivity;

    protected static $logFillable = true;
    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Content of Course has been {$eventName}";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
