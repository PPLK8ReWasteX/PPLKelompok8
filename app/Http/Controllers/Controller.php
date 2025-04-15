<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcoCycle; // Ensure this line is present
use App\Models\Vendor; // Ensure this line is present
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusUpdateNotification;

abstract class Controller
{











    
      // Menyimpan data pengajuan eco cycle
      public function store(Request $request)
      {
          $validated = $request->validate([
              'kategori_sampah' => 'required|string|max:255',
              'berat' => 'required|numeric',
              'alamat' => 'required|string|max:255',
              'deskripsi' => 'nullable|string',
              'foto' => 'required|image|max:2048', // Validasi file foto
              'vendor_id' => 'required|exists:vendors,id', // Validasi vendor_id
              'jadwal_pengambilan' => 'required|date|after:now', // Validasi jadwal pengambilan
          ]);
  
          // Debugging: Log the vendor_id being submitted
          \Log::info('Submitted Vendor ID: ' . $validated['vendor_id']);
  
          // Upload file foto
          if ($request->hasFile('foto')) {
              $path = $request->file('foto')->store('eco_cycles', 'public');
              $validated['foto'] = $path;
          }
  
          // Set data tambahan
          $validated['user_id'] = Auth::id();
          $validated['status'] = 'pending'; // Status default pengajuan
  
          // Buat record baru
          EcoCycle::create($validated);
  
          return redirect()->route('ecocycle.home')->with('success', 'Pengajuan EcoCycle berhasil dibuat.');
      }
}
