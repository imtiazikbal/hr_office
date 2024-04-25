<?php

namespace App\Http\Controllers;

use App\Models\DraftNews;
use Illuminate\Http\Request;

class DraftNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
            'reporter' => ['required', 'string', 'max:255'],
            'image' => ['required', 'max:20048'],
        ]);

        $img = $request->file('image');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/draft/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/draft'), $img_name);
        DraftNews::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'News successfully Save to Draft.');

    }

    /**
     * Display the specified resource.
     */
    public function show(DraftNews $draftNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DraftNews $draftNews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DraftNews $draftNews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DraftNews $draftNews)
    {
        //
    }
}
