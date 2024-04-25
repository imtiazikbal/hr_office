<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.position.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "name"=>["required","string","max:255"], 
             ]);
             Position::create([
                 "name" => $request->name,
                 "des" => $request->des
             ]);
             return response('success', 200);
        }catch(Exception $e){
            return response('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return Position::all();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return $position;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {

        try{
            $request->validate([
                "name"=>["required","string","max:255"], 
             ]);
             $position->update([
                 "name" => $request->name,
                 "des" => $request->des
             ]);
             return response()->json([
                 'message' => 'successfully update',
                 'status' => 201
             ]);
        }catch(Exception $e){
            return response('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json([
            'message' => 'successfully delete',
            'status' => 201
        ]);
    }
}
