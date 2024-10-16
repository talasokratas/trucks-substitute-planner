<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubunitRequest;
use App\Http\Requests\TruckRequest;
use App\Models\Truck;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trucks = Truck::with('subunits')->get();

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

    /**
     * @param $id
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function createSubunit($id)
    {
        $mainTruck = Truck::findOrFail($id);
        $subunits = Truck::where('id', '!=', $id)->get();

        return view('trucks.createSubunit', compact('mainTruck', 'subunits'));
    }

    /**
     * @param SubunitRequest $request
     * @return mixed
     */
    public function assignSubunit(SubunitRequest $request)
    {
        $request->validateRequest(); // This will call the validate method

        $truck = Truck::find($request->main_truck);
        $truck->subunits()->attach($request->subunit, [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subunit assigned successfully!',
        ]);
    }
}
