<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('supplier.profile.index', compact('user', 'countries'));
    }
    public function update(Request $request, $id)
    {
        if ($request->has('update_supplier')) {
            $request->validate([
                'name' => 'required|string|min:3',
                'company_name' => 'nullable|string',
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string',
                'email' => 'nullable|string',
                'website' => 'nullable|string',
                'tax_code' => 'nullable|string',
                'bank_account_number' => 'nullable|string',
                'bank_name' => 'nullable|string',
                'contact_person' => 'nullable|string',
                'contact_title' => 'nullable|string'
            ]);

            Supplier::find($id)->update($request->all());
            return redirect()->to(route('supplier.profile.index'))->with('success', 'Supplier has been updated completely!!');
        }
        if ($request->has('update_user')) {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'avatar' => 'required|file|max:2048',
                'address' => 'nullable',
                'phone_number' => 'nullable',
                'country_id' => 'required|'
            ]);
            $user  = User::find($id);

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                if (basename($user->avatar) !== $avatarFile->getClientOriginalName()) {
                    //dd($avatarFile, basename($user->avatar), $avatarFile->getClientOriginalName());
                    $avatarName = 'avatar-' . time() . '.' . $avatarFile->extension();

                    $avatarFile->move(public_path('storage/image/avatar'), $avatarName);

                    $validatedData['avatar'] = 'storage/image/avatar/' . $avatarName;
                } else {
                    $validatedData['avatar'] = $user->avatar;
                }
            }
            $user->update($validatedData);
            return redirect()->to(route('supplier.profile.index'))->with('success', 'User has been updated completely!!');
        }
        return redirect()->to(route('supplier.profile.index'))->with('error', 'Error!');
    }
}
