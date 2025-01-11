<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistance extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['type', 'quantity', 'donor_id', 'date', 'notes'];
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function distributes()
    {
        return $this->hasMany(Distribution::class);
    }
}
