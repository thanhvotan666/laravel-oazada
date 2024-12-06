<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $query = Supplier::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('company_name')) {
            $query->where('company_name', 'like', '%' . $request->input('company_name') . '%');
        }

        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->has('phone_number')) {
            $query->where('phone_number', 'like', '%' . $request->input('phone_number') . '%');
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->has('website')) {
            $query->where('website', 'like', '%' . $request->input('website') . '%');
        }

        if ($request->has('tax_code')) {
            $query->where('tax_code', 'like', '%' . $request->input('tax_code') . '%');
        }
        if ($request->has('bank_account_number')) {
            $query->where('bank_account_number', 'like', '%' . $request->input('bank_account_number') . '%');
        }
        if ($request->has('bank_name')) {
            $query->where('bank_name', 'like', '%' . $request->input('bank_name') . '%');
        }

        $suppliers = $query->paginate($perPage);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $supplierIds = Supplier::pluck('user_id');
        $users = User::where('role', 'supplier')->whereNotIn('id', $supplierIds)->get();
        return view('admin.suppliers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|string',
            'tax_code' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'contact_title' => 'nullable|string',
            'user_id' => 'required|exists:users,id'
        ]);

        Supplier::create($validatedData);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier)
    {

        return view('admin.suppliers.show', compact('supplier',));
    }

    public function edit(Supplier $supplier)
    {
        $supplierIds = Supplier::pluck('user_id');
        $users = User::where('role', 'supplier')->whereNotIn('id', $supplierIds)->get();
        return view('admin.suppliers.edit', compact('supplier', 'users'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|string',
            'tax_code' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'contact_title' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
