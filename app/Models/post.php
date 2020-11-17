<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('app\Models\User.php');
    }

    public function categoria()
    {
        return $this->belongsTo('app\Models\categoria.php');
    }

    public function likes()
    {
       return $this->hasMany('app\Models\Like.php');
    }

    public function comments()
    {
       return $this->hasMany('app\Models\comentario.php');
    }
}
