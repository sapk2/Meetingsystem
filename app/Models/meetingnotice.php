<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meetingnotice extends Model
{
    use HasFactory;
    protected $fillable=[
        'message',
        'meeting_id'
    ];
    public function meeting(){
        return $this->belongsTo(meeting::class);
    }
}
