<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaboration;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = Collaboration::latest()->get();

        return view('collaborations.index', compact('collaborations'));
    }
}
