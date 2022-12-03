<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'accounts';
    protected $fillable = [
        'username',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
    ];

    //Thiết lập quan hệ 1-1 với user
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    //Thiết lập quan hệ 1-1 với employee
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
