<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\CentreNews;
use Illuminate\Http\Request;

class CentreNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $centreNewses = CentreNews::with('user')->get();
       // return $centreNewses;
        return view('backend.pages.centre-news.index', compact('centreNewses'));
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
            'image' => ['required', 'max:2048'],
        ]);

        $img = $request->file('image');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/profile/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/profile'), $img_name);
       CentreNews::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);

     
        return redirect()->back()->with('success', 'News Send Central successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CentreNews $centreNews)
    {
        //return $centreNews;
        return view('backend.pages.centre-news.view', compact('centreNews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentreNews $centreNews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CentreNews $centreNews)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
           
        ]);
        if($request->hasFile('image')){
            $img = $request->file('image');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $imgUrl = "uploads/profile/{$img_name}";
    
            // Upload File
            $img->move(public_path('uploads/profile'), $img_name);
            $centreNews->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $imgUrl,
                'user_id' => $centreNews->user_id,
            ]);
        return redirect('centre')->with('success', 'News Updated Central News successfully.');

        }else{
            $centreNews->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $centreNews->image,
                'user_id' => $centreNews->user_id,
            ]);
        return redirect('centre')->with('success', 'News Updated Central News successfully.');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentreNews $centreNews)
    {
        //
    }
}
