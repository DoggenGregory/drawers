<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canvas extends Model
{
    protected $fillable = ['corX','corY','color','break'];

    public function canvas()
    {

        return $this->belongsTo(User::class);
    }
}
