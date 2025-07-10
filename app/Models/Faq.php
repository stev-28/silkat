<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }
}
