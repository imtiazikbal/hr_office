<?php

namespace App\Http\Controllers;
use Exception;
use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewsForwarding;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newses = News::whereDate('created_at', Carbon::today())->with('user', 'forward')->get();

        // Array to store chief reporter names
        $chiefReporterNames = [];

        // Iterate over each news article to retrieve the chief reporter's name
        foreach ($newses as $news) {
            // Check if the news has any forwardings
            if ($news->forward->isNotEmpty()) {
                // Iterate over each forwarding
                foreach ($news->forward as $forwarding) {
                    // Retrieve the chief reporter's ID from the forwarding
                    $chiefReporterId = $forwarding->chief_reporter_id;

                    // Retrieve the chief reporter using their ID
                    $chiefReporter = User::find($chiefReporterId);

                    // Check if the chief reporter exists and has a name
                    if ($chiefReporter && $chiefReporter->name) {
                        // Add the chief reporter's name to the array
                        $chiefReporterNames[] = $chiefReporter->name;
                    }
                }
            }
        }

        // Pass the chief reporter names and news articles to the view
        return view('backend.pages.news.index', compact('newses', 'chiefReporterNames'));
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
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
            'reporter' => ['required', 'string', 'max:255'],
            'image' => ['required', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:2048'],
        ]);

        $img = $request->file('image');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $imgUrl = "uploads/profile/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/profile'), $img_name);
        $news = News::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'comment' => $request->comment,
            'reporter' => $validatedData['reporter'],
            'image' => $imgUrl,
            'user_id' => auth()->user()->id,
        ]);

        // forwording
        NewsForwarding::create([
            'news_id' => $news->id,
            'chief_reporter_id' => $request->chief_reporter_id,
        ]);
        return redirect()->back()->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
