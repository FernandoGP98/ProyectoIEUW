<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo('app\Models\post.php');
    }

    public function user()
    {
        return $this->belongsTo('app\Models\User.php');
    }
}
