<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubEditor;
use App\Models\AssignNews;
use Illuminate\Http\Request;

class AssignNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function assignNewsToUser(Request $request, $subEditorId)
    {
        $subEditor = SubEditor::find($subEditorId);
        SubEditor::where('id', $subEditorId)->update([
            'status' => 6
        ]);

        // Attach users to the sub editor
        $subEditor->users()->attach($request->names);
        return redirect()->back()->with('success', 'Users News Assigned successfully!');
    }

    public function index()
    {

        $user = User::find(auth()->user()->id); // Get the user by ID
        $tasks = $user->subEditors; // Retrieve assigned tasks


        return view('backend.pages.tasks.index', compact('tasks'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubEditor $assignNews)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubEditor $news)
    {
      
       return view('backend.pages.tasks.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubEditor $news)
    {
        //dd($request->all());
        SubEditor::where('id', $news->id)->update([
            
                'title' => $news->title,
                'body' => $request->body,
                'comment' => $news->comment,
                'image' => $news->image,
                'user_id' => auth()->user()->id,
                'page_no' => $news->page_no,
                'column_no' => $news->column_no,
                'reporter_id' => $news->reporter_id,
                'news_id' => $news->news_id,

                'nType' => $news->nType,
                'start_time' => $news->start_time,
                'end_time' => null,
           
            
        ]);
        return redirect()->back()->with('success', 'News Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function isComplete(SubEditor $news)
    {
        $subEditor = $news;

    // Detach the authenticated user from the SubEditor record
    $subEditor->users()->detach(auth()->user()->id);
        return redirect()->route('assignNews')->with('success', 'News Complete successfully!');
    }
    
    public function destroy(AssignNews $assignNews)
    {
        //
    }
}
