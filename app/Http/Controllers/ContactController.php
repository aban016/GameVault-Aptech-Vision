<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::where('user_id', Auth::id())->get();
        return view('user.profile', compact('contacts'));
    }
    
    // ContactList for Admin
    public function contactList(){
        $contacts = Contact::all();
        return view('admin.contactlist', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'detail' => 'required|string',
            'attach_file' => 'nullable|image', 
        ]);

        $attachFile = null;
        if ($request->hasFile('attach_file')) {
            $attachFile = base64_encode(file_get_contents($request->file('attach_file')->path()));
        }

        $contactBy = Auth::id();

        $contact = Contact::create([
            'subject' => $request->input('subject'),
            'detail' => $request->input('detail'),
            'attach_file' => $attachFile,
            'contact_by' => $contactBy,
        ]);

        return redirect()->route('response')->with('success', 'Your report has been successfully sent!');
    }
}
