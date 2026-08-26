<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Admin/Contacts/Index', [
            'contacts' => $contacts
        ]);
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:pending,done',
        ]);

        $contact->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái liên hệ thành công!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Xóa liên hệ thành công!');
    }
}
