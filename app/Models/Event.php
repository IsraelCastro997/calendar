<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    static $rules = [
        // 'service_id' => 'required',
        'title' => 'required',
        'description' => 'required',
        'start' => 'required',
        'end' => 'required',

    ];
     protected $fillable = ['title', 'owner_id','description','start', 'end','isRealized'];

    // protected $fillable = ['service_id', 'client_id', 'title', 'owner_id', 'start', 'end', 'isRealized'];
}
