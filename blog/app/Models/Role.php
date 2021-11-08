<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const  ADMIN = 1;
    public const Moderator = 2;
    public const  User = 3;

    public function users(){
        return $this->hasMany(User::class);
    }
}
