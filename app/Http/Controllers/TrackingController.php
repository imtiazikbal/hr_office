<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SubEditor;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    function tracking($id)
    {
        try {
            $current_time = Carbon::now()->format('h:i:s A');
            SubEditor::where('id', $id)->update([
                'track_id' => auth()->user()->id,
                'start_time' => $current_time,
                'user_id' => auth()->user()->id,
            ]);

            $subEditor = SubEditor::find($id);
         
            $subEditor->logss()->attach(auth()->user()->id);

            return response('yes', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    function cancelTrack($id)
    {
        SubEditor::where('id', $id)->update([
            'track_id' => null,
            'start_time' => null,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('sub_editor')->with('success', 'Successfully Back Reading Central.');
    }
}
