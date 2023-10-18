<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'blogs';
    protected $fillable = ['title', 'content', 'publish_date', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
