<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'fk_department', 'fk_designation', 'phone_number'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'fk_department');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'fk_designation');
    }
}

