<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'address', 'notes'];
    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function distributions() {
        return $this->hasMany(Distribution::class);
    }
}
