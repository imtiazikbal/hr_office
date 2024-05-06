<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper\BengaliWordCounter;

class KPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function EmployeeKPI()
    {
        $kpiList = Reading::where('user_id', auth()->user()->id)
            ->selectRaw('DATE(created_at) as date')
            ->distinct()
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('j F Y');
            });
        //return $kpiList;

        return view('backend.pages.kpi.index', compact('kpiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function EmployeeKPIFilterByDate($date)
    {
        $startDate = Carbon::createFromFormat('j F Y', $date)->startOfDay();
        $endDate = Carbon::createFromFormat('j F Y', $date)->endOfDay();

        $employeeKPI = Reading::where('user_id', auth()->user()->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('complete', 1)
            ->with('user','user.employee','user.employee.position','user.employee.department')
            ->orderBy('id', 'desc')
            ->get();
        $sumOfAdd = 0;
        $sumOfOther = 0;

        foreach ($employeeKPI as $news) {
            $text = $news->body;
            $news->body = BengaliWordCounter::countWords($text);

            if ($news->nType == 'Advertisement') {
                $sumOfAdd += $news->body;
            } else {
                $sumOfOther += $news->body;
            }

        }
        
        return view('backend.pages.kpi.view', compact('employeeKPI', 'sumOfAdd', 'sumOfOther', 'date'));

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
    public function show(string $id)
    {
        $employeeKPI = Reading::whereDate('created_at', Carbon::today())
            ->where('user_id', auth()->user()->id)
            ->where('complete', 1)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($employeeKPI as $news) {
            $text = $news->body;
            $news->body = BengaliWordCounter::countWords($text);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EmployeeKPIFilterByFromToDate(Request $request)
    {
        //dd($request->all());
        $toDate= $request->to;
        $formDate= $request->from;

        $employeeKPI = Reading::where('user_id', $request->user_id)
        ->whereBetween('created_at', [$request->from, $request->to])
        ->where('complete', 1)
        ->with('user','user.employee','user.employee.position','user.employee.department')
        ->orderBy('id', 'desc')
        ->get();
        $sumOfAdd = 0;
        $sumOfOther = 0;

        foreach ($employeeKPI as $news) {
            $text = $news->body;
            $news->body = BengaliWordCounter::countWords($text);

            if ($news->nType == 'Advertisement') {
                $sumOfAdd += $news->body;
            } else {
                $sumOfOther += $news->body;
            }

        }

       // return $employeeKPI;
       return view('backend.pages.kpi.filterKpi', compact('employeeKPI', 'sumOfAdd', 'sumOfOther','toDate','formDate'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
