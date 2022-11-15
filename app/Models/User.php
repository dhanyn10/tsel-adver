<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $primaryKey = "id";
    protected $table = "user";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'telepon'
    ];
}
