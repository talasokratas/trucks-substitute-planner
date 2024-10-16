<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckRequest;
use App\Models\Truck;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trucks = Truck::all();

        return view('trucks.index', compact('trucks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trucks.create');
    }

    public function store(TruckRequest $request)
    {
        Truck::create($request->validated());

        return redirect()->route('trucks.index')->with('success', 'Truck created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $truck = Truck::findOrFail($id);

        return view('trucks.show', compact('truck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $truck = Truck::findOrFail($id);

        return view('trucks.edit', compact('truck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TruckRequest $request, $id)
    {
        $truck = Truck::findOrFail($id);
        $truck->update($request->validated());

        return redirect()->route('trucks.index')->with('success', 'Truck updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truck = Truck::findOrFail($id);
        $truck->delete();

        return redirect()->route('trucks.index')->with('success', 'Truck deleted successfully');
    }
}
