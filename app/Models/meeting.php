<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meeting extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'date_time',
        'user_id',
        'location'
    ];
    public function user(){
        return $this->belongsTo(user::class);
    }
}
