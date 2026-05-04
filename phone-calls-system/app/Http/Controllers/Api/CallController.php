<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Subscriber;
use App\Models\City;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CallController extends Controller
{
    public function index()
    {
        return response()->json(
            Call::with(['subscriber', 'city'])->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscriber_id' => 'required|exists:subscribers,id',
            'city_id' => 'required|exists:cities,id',
            'duration' => 'required|integer|min:1',
            'call_time' => 'required|date',
        ]);

        $subscriber = Subscriber::findOrFail($validated['subscriber_id']);
        $city = City::findOrFail($validated['city_id']);

        $hour = Carbon::parse($validated['call_time'])->hour;
        $rate = ($hour >= 8 && $hour < 22) ? $city->day_rate : $city->night_rate;
        $price = $validated['duration'] * $rate;

        $call = Call::create([
            'subscriber_id' => $subscriber->id,
            'city_id' => $city->id,
            'phone' => $subscriber->phone,
            'duration' => $validated['duration'],
            'price' => $price,
            'call_time' => $validated['call_time'],
        ]);

        return response()->json($call->load(['subscriber', 'city']), 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Call::with(['subscriber', 'city'])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $call = Call::findOrFail($id);

        $validated = $request->validate([
            'subscriber_id' => 'required|exists:subscribers,id',
            'city_id' => 'required|exists:cities,id',
            'duration' => 'required|integer|min:1',
            'call_time' => 'required|date',
        ]);

        $subscriber = Subscriber::findOrFail($validated['subscriber_id']);
        $city = City::findOrFail($validated['city_id']);

        $hour = Carbon::parse($validated['call_time'])->hour;
        $rate = ($hour >= 8 && $hour < 22) ? $city->day_rate : $city->night_rate;
        $price = $validated['duration'] * $rate;

        $call->update([
            'subscriber_id' => $subscriber->id,
            'city_id' => $city->id,
            'phone' => $subscriber->phone,
            'duration' => $validated['duration'],
            'price' => $price,
            'call_time' => $validated['call_time'],
        ]);

        return response()->json($call->load(['subscriber', 'city']));
    }

    public function destroy(string $id)
    {
        $call = Call::findOrFail($id);
        $call->delete();

        return response()->json([
            'message' => 'Call deleted successfully'
        ]);
    }
}