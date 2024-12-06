<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Mail\SupplierReplyMail;
use App\Models\Category;
use App\Models\SupplierContact;
use App\Models\SupplierReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supplier = auth()->user();
        $perPage = $request->input('per_page', 5);
        $query = SupplierContact::query()->orderByDesc('id');

        if ($request->has('replyed')) {
            //$query->where('code', 'like', '%' . $request->input('code') . '%');
        }

        $contacts = $query->paginate($perPage);
        $categories = Category::all();

        return view('supplier.contacts.index', compact('contacts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_contact_id' => 'required|exists:supplier_contacts,id|unique:supplier_replies,supplier_contact_id',
            'message' => 'required|string|min:8',
        ]);
        $contact = SupplierContact::find($request->supplier_contact_id);
        $email = $contact->user->email;
        //edit send email
        SupplierReply::create([
            'supplier_contact_id' => $request->supplier_contact_id,
            'message' => $request->message,
        ]);
        Mail::to($email)->send(new SupplierReplyMail($request->message, $contact->supplier));

        return back()->with('success', "Reply message successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
