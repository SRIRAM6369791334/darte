<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderByDesc('id')->paginate(10);
        $totalCount = Contact::count();

        return view('pages.contacts', compact('contacts', 'totalCount'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'Message deleted successfully!');
    }
}
