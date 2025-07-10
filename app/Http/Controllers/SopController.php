<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;

class SopController extends Controller
{
    public function index()
    {
        return Sop::with('faqs')->get();
    }
} 