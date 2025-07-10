<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    public function sops()
    {
        return $this->hasMany(Sop::class);
    }
}
