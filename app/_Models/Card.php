<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [ 
        'user_id', 'link_id', 'contact_id', 'document_id', 'active_id', 'card_no', 'status'
    ];
}
