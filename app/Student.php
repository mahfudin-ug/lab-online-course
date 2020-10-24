<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use HasUuidPrimary, LogsActivity;

    protected static $logFillable = true;
    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Student has been {$eventName}";
    }

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
