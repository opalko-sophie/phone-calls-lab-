<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::all();
        return view('admin.calls.index', compact('calls'));
    }

    public function create()
    {
        return view('admin.calls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'duration' => 'required|numeric|min:1',
        ]);

        Call::create($validated);

        return redirect()->route('admin.calls.index')
            ->with('success', 'Дзвінок успішно додано');
    }

    public function show(Call $call)
    {
        return view('admin.calls.show', compact('call'));
    }

    public function destroy(Call $call)
    {
        $call->delete();

        return redirect()->route('admin.calls.index')
            ->with('success', 'Запис успішно видалено');
    }
}