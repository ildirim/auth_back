<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'branch';
    protected $fillable = [
        'parent_id', 'name', 'status',
    ];

    public function parent() {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }
}
