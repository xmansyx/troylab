<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Model
{
    use  HasFactory;

    protected $table = 'schools';
    protected $guarded = [
        'id'
    ];

    public function students(){
        return $this->hasMany(Student::class);
    }
}
