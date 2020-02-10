<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
        protected $fillable = [
        'user_id', 'title', 'description', 'price',
    ];


    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function picture()
    {
        return $this->hasMany(Picture::class);
    }


}
