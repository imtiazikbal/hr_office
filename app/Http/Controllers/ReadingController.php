<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Helper\BengaliWordCounter;

use App\Models\RawNews;
use App\Models\Reading;
use Illuminate\Http\Request;

class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //my complete news
    public function completeNews()
    {
        $tComNews = Reading::whereDate('created_at', Carbon::today())
        ->where('user_id', auth()->user()->id)
        ->where('complete', 1)
        ->with('user', 'reporter')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        foreach ($tComNews as $news) {
            $text = $news->body;
            $news->body = BengaliWordCounter::countWords($text);
        }

        $tRnews = RawNews::whereDate('created_at', Carbon::today())
            ->where('user_id', auth()->user()->id)
            ->where('complete', 1)
            ->with('user', 'reporter')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.pages.reading.index', compact('tComNews', 'tRnews'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //my completed raw news

    public function rawNews()
    {

        $tComNews = Reading::where('user_id', auth()->user()->id)
        ->where('complete', 1)
        ->with('user', 'reporter')
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        $tRnews = RawNews::where('user_id', auth()->user()->id)
            ->where('complete', 1)
            ->with('user', 'reporter')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.pages.reading.rawNews', compact('tComNews','tRnews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function todayCompleteNews(Request $request)
    {
        $tComNews = Reading::whereDate('created_at', Carbon::today())
        ->where('complete', 1)
        ->with('user', 'reporter')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('backend.pages.reading.complete', compact('tComNews'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reading $reading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reading $reading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reading $reading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reading $reading)
    {
        //
    }
}
