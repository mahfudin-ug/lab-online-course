<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasUuidPrimary;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}