<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return response()->json(City::latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'day_rate' => 'required|numeric|min:0',
            'night_rate' => 'required|numeric|min:0',
        ]);

        $city = City::create($validated);

        return response()->json($city, 201);
    }

    public function show(string $id)
    {
        return response()->json(City::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'day_rate' => 'required|numeric|min:0',
            'night_rate' => 'required|numeric|min:0',
        ]);

        $city->update($validated);

        return response()->json($city);
    }

    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully'
        ]);
    }
}