<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\RawNews;
use App\Models\Reading;
use App\Models\Employee;
use App\Models\SubEditor;
use App\Models\CentreNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $newses = $newses
            ->with('user')
            ->orderBy('id', 'desc')
  

            ->with('track')
            ->paginate($request->input('datatable_length', 10));

        $employeeReading = User::whereHas('employee', function ($query) {
            $query->where('department_id', 1);
        })->get();

        //return $employeeReading;
        return view('backend.pages.sub-editor.index', compact('newses', 'employeeReading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function returnData(Request $request)
    {
        // $newses = SubEditor::with('user', 'track','logs')


   $newses = SubEditor::with('user', 'track','logs','reporter')
            ->orderBy('status', 'asc')
       

            ->with('track')
            ->get();

        return $newses;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $subEditor)
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
                'nType' => $request->nType,
            ]);

            News::where('id', $centreNews->news_id)->update(['status' => 2]);
            CentreNews::where('id', $centreNews->id)->update(['status' => 2]);
            $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

            News::where('id', $centreNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);
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
                'nType' => $request->nType,
            ]);

            News::where('id', $centreNews->news_id)->update(['status' => 2]);
            CentreNews::where('id', $centreNews->id)->update(['status' => 2]);

            $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database
            News::where('id', $centreNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);
            return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubEditor $subEditor)
    {
        //return $subEditor;
        return view('backend.pages.sub-editor.view', compact('subEditor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubEditor $subEditor)
    {
        $news = SubEditor::where('id', $subEditor->id)
            ->with('user')
            ->first();
        // return $news;
        return view('backend.pages.sub-editor.edit', compact('news'));
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
            'nType' => ['required', 'string'],
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
            $current_time = Carbon::now()->format('h:i:s A');
            $subEditor->update([
                'user_id' => auth()->user()->id,
                'track_id' => null,
                'end_time' => $current_time,
            ]);

            // here create raw news

            RawNews::create([
                'title' => $subEditorNews->title,
                'body' => $subEditorNews->body,
                'comment' => $subEditorNews->comment,
                'image' => $subEditorNews->image,
                'user_id' => $subEditorNews->auth()->user()->id,
                'page_no' => $subEditorNews->page_no,
                'column_no' => $subEditorNews->column_no,
                'reporter_id' => $subEditorNews->reporter_id,
                'news_id' => $subEditorNews->news_id,
                'complete' => 1,
                'nType' => $subEditorNews->nType,
                'start_time' => $subEditorNews->start_time,
                'end_time' => $current_time,
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
                'complete' => 1,
                'nType' => $subEditorNews->nType,
                'start_time' => $subEditorNews->start_time,
                'end_time' => $current_time,
            ]);

            News::where('id', $subEditorNews->news_id)->update(['status' => 4]);
            CentreNews::where('id', $subEditorNews->news_id)->update(['status' => 4]);
            SubEditor::where('news_id', $subEditorNews->news_id)->update(['status' => 5]);
            SubEditor::where('news_id', $subEditorNews->news_id)->update(['logs_id' => null]);

            $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

            News::where('id', $subEditorNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);

            return redirect()->route('sub_editor')->with('success', 'Successfully Update and Save.');
        } else {
            $current_time = Carbon::now()->format('h:i:s A');

            $subEditor->update([
                'user_id' => auth()->user()->id,
                'track_id' => null,
                'end_time' => $current_time,
            ]);

            // here create raw news

            RawNews::create([
                'title' => $subEditorNews->title,
                'body' => $subEditorNews->body,
                'comment' => $subEditorNews->comment,
                'image' => $subEditorNews->image,
                'user_id' => auth()->user()->id,
                'page_no' => $subEditorNews->page_no,
                'column_no' => $subEditorNews->column_no,
                'reporter_id' => $subEditorNews->reporter_id,
                'news_id' => $subEditorNews->news_id,
                'complete' => 1,
                'nType' => $subEditorNews->nType,
                'start_time' => $subEditorNews->start_time,
                'end_time' => $current_time,
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
                'complete' => 1,
                'nType' => $subEditorNews->nType,
                'start_time' => $subEditorNews->start_time,
                'end_time' => $current_time,
            ]);

            News::where('id', $subEditorNews->news_id)->update(['status' => 4]);
            CentreNews::where('id', $subEditorNews->id)->update(['status' => 4]);
            SubEditor::where('news_id', $subEditorNews->news_id)->update(['status' => 5]);
            SubEditor::where('news_id', $subEditorNews->news_id)->update(['logs_id' => null]);

            $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

            News::where('id', $subEditorNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);

            return redirect()->route('sub_editor')->with('success', 'Successfully Update and Save.');
        }
    }

    //Central News to Reading With Column No and Page No with News Type

    function check(Request $request, $id)
    {
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
            'user_id' => null,
            'page_no' => $validatedData['page_no'],
            'column_no' => $validatedData['column_no'],
            'reporter_id' => $centreNews->user_id,
            'news_id' => $centreNews->news_id,
            'nType' => $request->nType,
        ]);

        News::where('id', $centreNews->news_id)->update(['status' => 3]);
        CentreNews::where('id', $centreNews->id)->update(['status' => 3]);

        return response('yes', 200);

        // return redirect()->route('sub_editor')->with('success', 'News Send Sub Editor successfully.');
    }

    // Get Who Edit The News [ show his/her Name in fontend]

    function tracking(Request $request, $id)
    {
        try {
            $current_time = Carbon::now()->format('h:i:s A');
            SubEditor::where('id', $id)->update([
                'track_id' => auth()->user()->id,
                'start_time' => $current_time,
                'user_id' => auth()->user()->id,
            ]);

            return response('yes', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    function cancelTrack(Request $request, $id)
    {
        SubEditor::where('id', $id)->update([
            'track_id' => null,
            'start_time' => null,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('sub_editor')->with('success', 'Successfully Back Reading Central.');
    }

    function updateCentralNewsbyReading(Request $request, SubEditor $subEditor)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'reporter' => ['required', 'string', 'max:255'],
            'page_no' => ['required', 'integer'],
            'column_no' => ['required', 'integer'],
            'nType' => ['required', 'string'],
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
            $current_time = Carbon::now()->format('h:i:s A');
            $subEditor->update([
                'user_id' => auth()->user()->id,
                'track_id' => null,
                'end_time' => $current_time,
            ]);

            // Update SubEditor Table(Reading Centre News)

            SubEditor::where('id', $subEditor->id)->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $subEditor->image,
                'user_id' => auth()->user()->id,
                'page_no' => $validatedData['page_no'],
                'column_no' => $validatedData['column_no'],
                'reporter_id' => $subEditor->user_id,
                'news_id' => $subEditor->news_id,
                'nType' => $request->nType,
                'logs_id' => auth()->user()->id,
                'updated_at' => $current_time,
                
            ]);

            $currentDateTime = now()->toDateTimeString();

            News::where('id', $subEditorNews->news_id)->update(['status' => 4]);
            CentreNews::where('id', $subEditorNews->news_id)->update(['status' => 4]);

            // SubEditor::where('news_id', $subEditorNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);

            $currentDateTime = now()->toDateTimeString(); // Get current datetime in a format compatible with your database

            News::where('id', $subEditorNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);

            return redirect()->route('sub_editor')->with('success', 'Successfully Updated the News.');


        } else {
            $current_time = Carbon::now()->format('h:i:s A');

            $subEditor->update([
                'user_id' => auth()->user()->id,
                'track_id' => null,
                'end_time' => $current_time,
            ]);


            SubEditor::where('id', $subEditor->id)->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $subEditor->image,
                'user_id' => auth()->user()->id,
                'page_no' => $validatedData['page_no'],
                'column_no' => $validatedData['column_no'],
                'reporter_id' => $subEditor->user_id,
                'news_id' => $subEditor->news_id,
                'nType' => $request->nType,
                
            ]);
         
            $currentDateTime = now()->toDateTimeString();


            News::where('id', $subEditorNews->news_id)->update(['status' => 4]);
            CentreNews::where('id', $subEditorNews->id)->update(['status' => 4]);
  
            SubEditor::where('news_id', $subEditorNews->news_id)->update(['logs_id' => auth()->user()->id, 'updated_at' => $currentDateTime]);

           // Get current datetime in a format compatible with your database

            News::where('id', $subEditorNews->news_id)->update(['logs' => auth()->user()->id, 'updated_at' => $currentDateTime]);

            return redirect()->route('sub_editor')->with('success', 'Successfully Updated the News.');
        }
    }


    function destroy(SubEditor $subEditor){
        File::delete(public_path($subEditor->image));
        $subEditor->delete();

    }
}
