<?php

namespace App\Http\Controllers;

use App\Models\LIVRE;
use Illuminate\Http\Request;

class LIVREController extends Controller
{
    /**
     * @group Livres
     * Get a list of livres.
     */
    public function index()
    {
        return response()->json(LIVRE::all(), 200);


    }

    /**
     * @group Livres
     * Get a specific livre.
     */
    public function show($id)
    {
        if(!LIVRE::where('id', $id)->exists()){
            return response()->json(['message' => 'Livre not found'], 404);
        }
        return response()->json(LIVRE::find($id), 200);
    }
    /**
     * @group Livres
     * Create a new livre.
     * 
     * @bodyParam titre string required The title of the livre.
     * @bodyParam auteur string required The author of the livre.
     * @bodyParam annee date required The publication year of the livre.
     * @bodyParam genre string required The genre of the livre.
     * @bodyParam isbn string required The ISBN of the livre.
     * @bodyParam quantite integer required The quantity of the livre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre'=>'required|string|max:255',
            'auteur'=>'required|string|max:255',
            'annee'=>'required|date',
            'genre'=>'required|string|max:255',
            'isbn'=>'required|string|max:255',
            'quantite'=>'required|integer',
        ]);

        try {
            $livre = LIVRE::create($request->all());
            return response()->json($livre, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create livre'], 500);
        }

    }
    /**
     * @group Livres
     * Update a specific livre.
     * 
     * @bodyParam titre string The title of the livre.
     * @bodyParam auteur string The author of the livre.
     * @bodyParam annee date The publication year of the livre.
     * @bodyParam genre string The genre of the livre.
     * @bodyParam isbn string The ISBN of the livre.
     * @bodyParam quantite integer The quantity of the livre.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'string|max:255|optional',
            'auteur' => 'string|max:255|optional',
            'annee' => 'date|optional',
            'genre' => 'string|max:255|optional',
            'isbn' => 'string|max:255|optional',
            'quantite' => 'integer|optional',
        ]);
        if (!LIVRE::where('id', $id)->exists()) {
            return response()->json(['message' => 'Livre not found'], 404);
        }
        $livre = LIVRE::find($id);
        $livre->update($request->all());
        return response()->json($livre, 200);
    }
    /**
     * @group Livres
     * Delete a specific livre.
     */
    public function destroy($id)
    {
        if (!LIVRE::where('id', $id)->exists()) {
            return response()->json(['message' => 'Livre not found'], 404);
        }
        $livre = LIVRE::find($id);
        $livre->delete();
        return response()->json(['message' => 'Livre deleted successfully'], 200);
    
    }

}
