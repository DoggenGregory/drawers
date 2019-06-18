<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\User;

class Canvas extends Model
{
    protected $fillable = [
        'corX',
        'corY',
        'color',
        'thickness',
        'break'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
