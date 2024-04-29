<?php

namespace App\Http\Controllers;

use App\Models\CentreNews;
use Exception;
use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewsForwarding;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

      $newses = News::whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->with('log','user')->get();
 
        
      // return $newses;

        // Pass the chief reporter names and news articles to the view
     return view('backend.pages.news.index', compact('newses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.news.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
      

        return redirect()->back()->with('success', 'News successfully Send To Centre.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('backend.pages.news.view', compact('news'));

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
       return view('backend.pages.news.edit', compact('news'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
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
        $news->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'News Updated Save to Draft successfully.');


    }else{

        $news->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'user_id' => auth()->user()->id,
            'image' => $news->image,
        ]);
        return redirect('/news')->with('success', 'News Updated Save to Draft successfully.');

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        File::delete($news->image);
        // Delete the image
        $news->delete();
      
    }
}
