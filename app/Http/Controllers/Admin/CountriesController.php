<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $query = Country::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('code')) {
            $query->where('code', 'like', '%' . $request->input('code') . '%');
        }

        if ($request->has('currency')) {
            $query->where('currency', 'like', '%' . $request->input('currency') . '%');
        }

        $countries = $query->paginate($perPage);
        return view('admin.countries.index', compact('countries'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'code' => 'required|string|max:2|unique:countries,code',
            'image' => 'nullable|max:2048',
            'currency' => 'required|string|max:255',
        ]);
        try {
            if ($request->hasFile('image')) {
                $image = '/' . $validatedData['code'] . '-' . time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('storage/image/country'), $image);
                $validatedData['image'] = 'storage/image/country' . $image;
            }

            Country::create($validatedData);

            return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error uploading image. Please try again.');
        };
    }

    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:2',
            'image' => 'nullable|max:2048',
            'currency' => 'required|string|max:255',
        ]);
        try {
            $imageSrc = '';
            if ($request->hasFile('image')) {
                $imageName = '/' . $validatedData['code'] . '-' . time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('storage/image/country'), $imageName);
                $validatedData['image'] = 'storage/image/country' . $imageName;
            }

            $country->update($validatedData);
            return redirect()->route('admin.countries.index')->with('success',  'Country update successfully.');
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error uploading image. Please try again.');
        };
    }

    public function destroy(Country $country)
    {
        User::where('country_id', $country->id)
            ->update(['country_id' => null]);

        $country->delete();

        return redirect()->route('admin.countries.index')->with(
            'success',
            'Country deleted successfully.'
        );
    }
}
