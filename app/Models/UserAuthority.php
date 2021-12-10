<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthority extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_authority';
    protected $fillable = [
        'user_id', 'branch_id', 'position_id', 'importance_level', 'status',
    ];

    public function user()
    {
        return $this->belongsToOne(App\Models\User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsToOne(App\Models\User::class, 'branch_id');
    }
}
