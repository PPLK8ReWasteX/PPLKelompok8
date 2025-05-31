<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
        ]);

       
    }
}