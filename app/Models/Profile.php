<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'avatar',
        'phone_number',
        'birth_date',
        'gender',
        'address',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
