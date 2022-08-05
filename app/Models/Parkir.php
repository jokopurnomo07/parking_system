<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;
    protected $table = 'parkir';
    protected $guarded = [];

    public function parkirKeluar()
    {
        return $this->hasOne(ParkirKeluar::class, 'parkir_id', 'id');
    }
}
