<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = ['gender_id','organization_name','location','city','designation','user_id'];

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
