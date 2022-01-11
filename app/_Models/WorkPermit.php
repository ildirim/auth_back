<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'maker_id', 'executor_id', 'from', 'to', 'reason', 'approved_by1', 'approved_at1', 'approved_by2', 'approved_at2', 'approved_by3', 'approved_at3', 'reject_reason', 'rejected_at', 'status'
    ];
}
