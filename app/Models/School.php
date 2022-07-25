<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Model
{
    use  HasFactory, SoftDeletes;

    protected $table = 'schools';
    protected $guarded = [
        'id'
    ];

    public function students(){
        return $this->hasMany(Student::class);
    }
}
