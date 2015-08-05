<?php

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo('SimpleLance\User');
    }
}
