<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\CentreNews;
use App\Models\DraftNews;
use Illuminate\Http\Request;

class CentreNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centreNewses = CentreNews::with('user')->where('status', '=', 0)->get();
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
    public function view()

    {
       $news =  CentreNews::where('status','=',2)->get();
       return view('backend.pages.centre-news.sub-editor-news', compact('news'));
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
            'image' => ['required', 'max:2048'],
        ]);

        $img = $request->file('image');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/draft/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/draft'), $img_name);

        $news = News::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);

        News::where('id', $news->id)->update(['status' => 1]);

        CentreNews::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
            'news_id' => $news->id,
        ]);
        if ($news->status == 'draft') {
            DraftNews::where('id', $news->id)->delete();
        }

        return redirect()->route('news')->with('success', 'News Send Central successfully.');
    }

    function draft_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'reporter' => ['required', 'string', 'max:255'],
        ]);

        $draftNews = DraftNews::find($id);
        $draftImage = $draftNews->image;

        if ($request->hasFile('image')) {
            $img = $request->file('image');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $imgUrl = "uploads/myNews/{$img_name}";

            // Upload File
            $img->move(public_path('uploads/myNews'), $img_name);

            $news = News::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'reporter' => $validatedData['reporter'],
                'image' => $imgUrl,
                'user_id' => auth()->user()->id,
            ]);

            News::where('id', $news->id)->update(['status' => 1]);

            CentreNews::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $imgUrl,
                'user_id' => auth()->user()->id,
                'news_id' => $news->id,
            ]);

            DraftNews::where('id', $id)->delete();

            return redirect()->route('news')->with('success', 'News Send Central successfully.');
        } else {
            $news = News::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'reporter' => $validatedData['reporter'],
                'image' => $draftImage,
                'user_id' => auth()->user()->id,
            ]);

            News::where('id', $news->id)->update(['status' => 1]);

            CentreNews::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'comment' => $request->comment,
                'image' => $draftImage,
                'user_id' => auth()->user()->id,
                'news_id' => $news->id,
            ]);

            DraftNews::where('id', $id)->delete();
            return redirect()->route('news')->with('success', 'News Send Central successfully.');
        }
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
        $centreNews =  CentreNews::with('user')->find($centreNews->id);
       // return $centreNews;
       return view('backend.pages.centre-news.edit', compact('centreNews'));
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
        if ($request->hasFile('image')) {
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
        } else {
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
