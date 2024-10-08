<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];


    public function seasons()
    {
        $this->belongsTo(Season::class);
    }
}
