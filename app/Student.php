<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasUuidPrimary;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
