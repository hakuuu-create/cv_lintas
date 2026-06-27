<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kreator extends Model
{
    protected $table = 'kreator';
    protected $fillable = ['nama', 'username', 'platform', 'foto'];
}