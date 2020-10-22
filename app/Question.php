<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasUuidPrimary;

    protected $guarded = [];

    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSE = 'CLOSE';
    const STATUS_SOLVED = 'SOLVED';

    public function creator()
    {
        return $this->belongsTo(User::class);
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
