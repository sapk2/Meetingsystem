<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agendas extends Model
{
    use HasFactory;
    protected $fillable=[
        'meeting_id',
        'agenda_title',
        'attachment'
    ];
    public function meeting(){
        return $this->belongsTo(meeting::class);
    }
}
