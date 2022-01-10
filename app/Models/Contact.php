<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 'photo', 'full_name', 'company', 'department', 'role', 'address', 'mobile_number', 'fax_number', 'email', 'note'
    ];
}
