<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use HasUuidPrimary, LogsActivity;

    protected static $logFillable = true;
    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Course has been {$eventName}";
    }

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
