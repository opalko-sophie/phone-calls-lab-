<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        return response()->json(Subscriber::latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:subscribers,phone',
        ]);

        $subscriber = Subscriber::create($validated);

        return response()->json($subscriber, 201);
    }

    public function show(string $id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return response()->json($subscriber);
    }

    public function update(Request $request, string $id)
    {
        $subscriber = Subscriber::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:subscribers,phone,' . $subscriber->id,
        ]);

        $subscriber->update($validated);

        return response()->json($subscriber);
    }

    public function destroy(string $id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();

        return response()->json([
            'message' => 'Subscriber deleted successfully'
        ]);
    }
}