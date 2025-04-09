<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcoCycle; // Ensure this line is present
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusUpdateNotification;

class EcoCycleController extends Controller
{
    // Menampilkan daftar pengajuan eco cycle untuk user yang sedang login
    public function index()
    {
        $ecoCycles = EcoCycle::where('user_id', Auth::id())->get();
        $vendors = Vendor::all(); // Fetch all vendors
        return view('ecocycle-home', compact('ecoCycles', 'vendors')); // Pass vendors to the view
    }

}