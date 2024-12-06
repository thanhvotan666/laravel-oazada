<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
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

        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->has('country_id')) {
            $query->where('country_id', $request->input('country_id'));
        }

        $users = $query->paginate($perPage);
        $countries = Country::all();
        $id = Auth::id();
        return view('admin.users.index', compact('users', 'countries', 'id'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.users.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'avatar' => 'nullable|max:2048',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'role' => 'required|in:customer,admin,supplier,writer',
            'country_id' => 'required|exists:countries,id',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        // Handle avatar upload (optional)
        try {
            if ($request->hasFile('avatar')) {
                $avatarName = '/avatar-' . time() . '.' . $request->file('avatar')->extension();
                $request->file('avatar')->move(public_path('storage/image/avatar'), $avatarName);
                $validatedData['avatar'] = 'storage/image/avatar' . $avatarName;
            }

            User::create($validatedData);

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully. ');
        } catch (\Exception $e) {
            // Log lỗi để debug
            Log::error('Error uploading avatar: ' . $e->getMessage());

            // Redirect trở lại với thông báo lỗi
            return redirect()->back()->with('error', 'Error uploading avatar. Please try again.');
        };
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->get();
        $reviews = ProductReview::where('user_id', $id)->get();
        $countries = Country::all();
        return view('admin.users.show', compact(
            'user',
            'orders',
            'reviews',
            'countries'
        ));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::all();
        return view('admin.users.edit', compact('user', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255' . ($request->email !== $user->email ? '|unique:users' : ''),
            'avatar' => 'nullable|max:2048',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'role' => 'required|in:customer,admin,supplier,writer',
            'country_id' => 'required|exists:countries,id',
        ]);

        try {
            if ($request->hasFile('avatar')) {
                $avatarName = '/avatar-' . time() . '.' . $request->file('avatar')->extension();
                $request->file('avatar')->move(public_path('storage/image/avatar'), $avatarName);
                $validatedData['avatar'] = 'storage/image/avatar' . $avatarName;
            }
            //dd($validatedData);
            // if ($validatedData['role'] === 'supplier') {
            //     $supplier = Supplier::where('user_id', $user->id)->get();
            //     if ($supplier->isEmpty()) {
            //         Supplier::create([
            //             'user_id' => $user->id,
            //             'name' => 'Shop name',
            //             'company_name' => "Company name",
            //             'address' => $user->address,
            //             'phone_number' =>  $user->phone_number,
            //             'email' =>  $user->email,
            //             'website' => "Link website! (website.com)",
            //             'tax_code' => "Tax code",
            //             'bank_account_number' => "Bank account number",
            //             'bank_name' => "Bank name",
            //             'contact_person' => $user->name,
            //             'contact_title' => "Manager",
            //         ]);
            //     }
            // }
            $user->update($validatedData);

            return redirect()->route('admin.users.show', ['user' =>  $user->id])->with('success', 'User updated successfully.');
        } catch (\Exception $e) {

            Log::error('Error uploading avatar: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error uploading avatar. Please try again.');
        };
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.users.index')->with('error', "You need to transfer or delete the supplier first.");
        }
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
