<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function faqs()
    {
        return $this->hasMany(\App\Models\Faq::class);
    }

    public function sop()
    {
        return $this->belongsTo(\App\Models\Sop::class);
    }
}
