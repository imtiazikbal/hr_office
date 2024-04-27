<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SubEditor;
use App\Models\CentreNews;
use Illuminate\Http\Request;

class SubEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $news = SubEditor::with('user')->get();
       return view('backend.pages.sub-editor.index',compact('news'));
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
    public function store(Request $request,$subEditor)
    {
    //   dd($request->all());
      $validatedData = $request->validate([
        'title' => ['required', 'string'],
        'body' => ['required', 'string'],
        'reporter' => ['required', 'string', 'max:255'],
     
        'page_no' => ['required', 'integer'],
        'column_no' => ['required', 'integer'],
    ]);

    $centreNews = CentreNews::find($subEditor);
    $getCentreNewsImage = $centreNews->image;


    if ($request->hasFile('image')) {
        $img = $request->file('image');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/subEditor/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/subEditor'), $img_name);

    SubEditor::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
            'page_no' => $validatedData['page_no'],
            'column_no' => $validatedData['column_no'],
            'reporter_id' => $centreNews->user_id,
            'news_id' => $centreNews->news_id,
        ]);

        News::where('id', $centreNews->news_id)->update(['status' => 2]);
        CentreNews::where('id', $centreNews->id)->update(['status' => 2]);

        return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');


    } else {
       SubEditor::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
        
            'image' => $getCentreNewsImage,
            'user_id' => auth()->user()->id,
            'page_no' => $validatedData['page_no'],
            'column_no' => $validatedData['column_no'],
            'reporter_id' => $centreNews->user_id,
            'news_id' => $centreNews->news_id,
        ]);

        News::where('id', $centreNews->news_id)->update(['status' => 2]);
        CentreNews::where('id', $centreNews->id)->update(['status' => 2]);
        return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubEditor $subEditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubEditor $subEditor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubEditor $subEditor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubEditor $subEditor)
    {
        //
    }
}
