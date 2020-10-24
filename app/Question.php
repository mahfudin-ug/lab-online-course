<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use HasUuidPrimary, LogsActivity;

    protected static $logFillable = true;
    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Question has been {$eventName}";
    }

    protected $guarded = [];

    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSE = 'CLOSE';
    const STATUS_SOLVED = 'SOLVED';

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
