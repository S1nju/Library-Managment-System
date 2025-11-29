<?php

namespace App\Http\Controllers;

use App\Models\RETARD;
use Illuminate\Http\Request;

class RetardController extends Controller
{
    /**
     * @group Retards
     * Get a list of retards.
     */
    public function index()
    {
        return response()->json(RETARD::paginate(10), 200);
    }
    /**
     * @group Retards
     * Get  retards by id.
     */
    public function show($id)
    {
        if (!RETARD::where('id', $id)->exists()) {
            return response()->json(['message' => 'Retard not found'], 404);
        }
        return response()->json(RETARD::find($id), 200);
    }
    /**
     * @group Retards
     * Create a new retard.
     *
     * @bodyParam emprunt_id 
     * 
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'emprunt_id' => 'required|integer|exists:emprunts,id',
            'date_retard' => 'required|date',
            'montant' => 'required|numeric',
        ]);

        try {
            $retard = RETARD::create($request->all());
            return response()->json($retard, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create retard'], 500);
        }
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'emprunt_id' => 'integer|exists:emprunts,id|optional',
            'date_retard' => 'date|optional',
            'montant' => 'numeric|optional',
        ]);
        if (!RETARD::where('id', $id)->exists()) {
            return response()->json(['message' => 'Retard not found'], 404);
        }
        $retard = RETARD::find($id);
        $retard->update($request->all());
        return response()->json($retard, 200);
    }
    public function destroy($id)
    {
        if(!RETARD::where('id', $id)->exists()){
            return response()->json(['message' => 'Retard not found'], 404);
        }
        $retard = RETARD::find($id);
        $retard->delete();
        return response()->json(['message' => 'Retard deleted successfully'], 200);
    }

}
