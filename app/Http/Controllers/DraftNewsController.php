<?php

namespace App\Http\Controllers;

use App\Models\DraftNews;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class DraftNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $draftNews = DraftNews::where('user_id', auth()->user()->id)->get();
        return view('backend.pages.draft.index', compact('draftNews'));
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
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
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
function draft_store(Request $request){
    
}
    /**
     * Display the specified resource.
     */
    public function show(DraftNews $news)
    {
       return view('backend.pages.draft.view', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DraftNews $draftNews)
    {
       return view('backend.pages.draft.edit', compact('draftNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DraftNews $draftNews)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'reporter' => ['required', 'string', 'max:255'],
           
        ]);

        if($request->hasFile('image')){
            
        $img = $request->file('image');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/draft/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/draft'), $img_name);
        $draftNews->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('draft')->with('success', 'News successfully Updated Save to Draft.');

        }else{
            $draftNews->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'reporter' => $validatedData['reporter'],
                'image' => $draftNews->image,
                'user_id' => auth()->user()->id,
            ]);
        return redirect()->route('draft')->with('success', 'News successfully Updated Save to Draft.');

        }
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DraftNews $draftNews)
    {
       File::delete($draftNews->image);
       $draftNews->delete();
    }
}
