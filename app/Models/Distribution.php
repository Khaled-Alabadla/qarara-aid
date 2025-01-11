<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = ['user_id', 'donor_id', 'assistance_id', 'quantity'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assistance()
    {
        return $this->belongsTo(Assistance::class);
    }

    public function donor() {
        return $this->belongsTo(Donor::class);
    }
}
