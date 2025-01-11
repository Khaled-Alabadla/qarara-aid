<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
   
    protected $fillable = ['file_name'];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
