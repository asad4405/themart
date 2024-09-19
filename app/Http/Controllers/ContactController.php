<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function contact_list ()
    {
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    function contact_show ($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.show',compact('contact'));
    }
}
