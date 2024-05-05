<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SubEditor;
use App\Models\CentreNews;
use App\Models\RawNews;
use App\Models\Reading;
use Illuminate\Http\Request;

class SubEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newses = SubEditor::query();

        // Filter by search query if provided
        if ($request->has('search')) {
            $newses->where('title', 'like', '%' . $request->input('search') . '%');
        }
    
        // Paginate the results
        $newses = $newses->with('user')
                         ->orderBy('id', 'desc')
                         ->where('status', '!=', 4)
                         ->with('track')
                         ->paginate($request->input('datatable_length', 10));
    


                      // return $newses;
                         return view('backend.pages.sub-editor.test', compact('newses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function returnData(Request $request)
    {
        $newses = SubEditor::query();

      
    
        // Paginate the results
        $newses = $newses->with('user')
                         ->orderBy('id', 'desc')
                         ->where('status', '!=', 4)
                         ->with('track')->get();
                        
    


                     return $newses;
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
        $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

        News::where('id', $centreNews->news_id)
            ->update(['logs' => auth()->user()->id ,
            'updated_at' => $currentDateTime]);
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

        $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database
        News::where('id', $centreNews->news_id)
        ->update(['logs' => auth()->user()->id,
        'updated_at' => $currentDateTime]);
        return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubEditor $subEditor)
    {
       //return $subEditor;
       return view('backend.pages.sub-editor.view',compact('subEditor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubEditor $subEditor)
    {
        $news = SubEditor::where('id', $subEditor->id)->with('user')->first();
       // return $news;
        return view('backend.pages.sub-editor.edit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubEditor $subEditor)
    {
    

      $validatedData = $request->validate([
        'title' => ['required', 'string'],
        'body' => ['required', 'string'],
        'reporter' => ['required', 'string', 'max:255'],
        'page_no' => ['required', 'integer'],
        'column_no' => ['required', 'integer'],
    ]);


    $subEditorNews = SubEditor::find($subEditor->id);
    $subEditorNewsImage = $subEditorNews->image;

    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/subEditor/{$img_name}";
        // Upload File
        $img->move(public_path('uploads/subEditor'), $img_name);
       
        $subEditor->update([
           
            'user_id' => auth()->user()->id,
            'track_id' => null,

        ]);

        // here create raw news

        RawNews::create([
            'title' => $subEditorNews->title,
            'body' =>$subEditorNews->body,
            'comment' => $subEditorNews->comment,
            'image' => $subEditorNews->image,
            'user_id' => $subEditorNews->auth()->user()->id,
            'page_no' => $subEditorNews->page_no,
            'column_no' => $subEditorNews->column_no,
            'reporter_id' => $subEditorNews->reporter_id,
            'news_id' => $subEditorNews->news_id,
            'complete' => 1
        ]);



  // here create update news
        Reading::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
            'page_no' => $validatedData['page_no'],
            'column_no' => $validatedData['column_no'],
            'reporter_id' => $subEditorNews->reporter_id,
            'news_id' => $subEditorNews->news_id,
            'complete' => 1
        ]);



        News::where('id',  $subEditorNews->news_id)->update(['status' => 4]);
        CentreNews::where('id',$subEditorNews->news_id)->update(['status' => 4]);
        SubEditor::where('news_id',$subEditorNews->news_id)->update(['status' => 4]);

        $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

        News::where('id', $subEditorNews->news_id)
            ->update(['logs' => auth()->user()->id,
            'updated_at' => $currentDateTime]);

            return redirect()->route('sub_editor')->with('success', 'Successfully Update and Save.');


    } else {
        $subEditor->update([
        
            'user_id' => auth()->user()->id,
            'track_id' => null,
        ]);

// here create raw news

        RawNews::create([
            'title' => $subEditorNews->title,
            'body' =>$subEditorNews->body,
            'comment' => $subEditorNews->comment,
            'image' => $subEditorNews->image,
            'user_id' => auth()->user()->id,
            'page_no' => $subEditorNews->page_no,
            'column_no' => $subEditorNews->column_no,
            'reporter_id' => $subEditorNews->reporter_id,
            'news_id' => $subEditorNews->news_id,
            'complete' => 1
        ]);
// here create update news

        Reading::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'image' => $subEditorNewsImage,
            'user_id' => auth()->user()->id,
            'page_no' => $validatedData['page_no'],
            'column_no' => $validatedData['column_no'],
            'reporter_id' => $subEditorNews->user_id,
            'news_id' => $subEditorNews->news_id,
            'complete' => 1
        ]);

        News::where('id', $subEditorNews->news_id)->update(['status' => 4]);
        CentreNews::where('id', $subEditorNews->id)->update(['status' => 4]);
        SubEditor::where('news_id',$subEditorNews->news_id)->update(['status' => 4]);

         
        $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

        News::where('id', $subEditorNews->news_id)
            ->update(['logs' => auth()->user()->id
            ,'updated_at' => $currentDateTime]);

        return redirect()->route('sub_editor')->with('success', 'Successfully Update and Save.');
    }
       
    }

    function check(Request $request, $id){


       
      
        $validatedData = $request->validate([
            'page_no' => ['required', 'integer'],
            'column_no' => ['required', 'integer'],
        ]);
        $centreNews = CentreNews::find($id);
        SubEditor::create([
                'title' => $centreNews->title,
                'body' => $centreNews->body,
                'comment' => $request->comment,
                'image' => $centreNews->image,
                'user_id' => auth()->user()->id,
                'page_no' => $validatedData['page_no'],
                'column_no' => $validatedData['column_no'],
                'reporter_id' => $centreNews->user_id,
                'news_id' => $centreNews->news_id,
            ]);
    
            News::where('id', $centreNews->news_id)->update(['status' => 3]);
            CentreNews::where('id', $centreNews->id)->update(['status' => 3]);

            return response('yes', 200);
    
           // return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');
    
        } 

       
      


            function tracking(Request $request, $id){
              try{
                SubEditor::where('id',$id)->update([
                    'track_id' => auth()->user()->id
                ]);
                return response('yes', 200);
              }catch(\Exception $e){
                return response($e->getMessage(), 500);
              }
            }

            function cancelTrack(Request $request, $id){

                SubEditor::where('id',$id)->update([
                    'track_id' => null
                ]);
               return redirect()->route('sub_editor')->with('success', 'Successfully Back Reading Central.');
            }


    }
