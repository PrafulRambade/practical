<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','user_id'];

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
