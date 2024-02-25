<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\AvailableTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvailableTimeController extends Controller
{
    public function addAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,fully_booked,closed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $availableTime = new AvailableTime();
        $availableTime->date = $request->input('date');
        $availableTime->start_time = $request->input('start_time');
        $availableTime->end_time = $request->input('end_time');
        $availableTime->capacity = $request->input('capacity');
        $availableTime->status = $request->input('status');
        $availableTime->save();

        return redirect()->route('administrator.availableTime')->with('success', 'Available time added successfully!');
    }

    public function updateAvailableTime(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,fully_booked,closed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $availableTime = AvailableTime::findOrFail($id);
        $availableTime->date = $request->input('date');
        $availableTime->start_time = $request->input('start_time');
        $availableTime->end_time = $request->input('end_time');
        $availableTime->capacity = $request->input('capacity');
        $availableTime->status = $request->input('status');
        $availableTime->save();

        return redirect()->route('administrator.availableTime')->with('success', 'Available time updated successfully!');
    }

    public function viewAllAvailableTimes()
    {
        $availableTimes = AvailableTime::orderBy('id', 'desc')->get();
        return view('administrator.availableTime', compact('availableTimes'));
    }


    public function viewAvailableTime($id)
    {
        $availableTime = AvailableTime::findOrFail($id);
        $availableTimes = AvailableTime::orderBy('id', 'desc')->get();
        return view('administrator.availableTime', compact('availableTime','availableTimes'));
    }

    public function deleteAvailableTime($id)
    {
        // Find the available time by ID
        $availableTime = AvailableTime::findOrFail($id);

        // Check if the available time is fully booked
        if ($availableTime->status === 'fully_booked') {
            return redirect()->route('administrator.availableTime')->with('error', 'Cannot delete fully booked available time!');
        }

        // Delete the available time
        $availableTime->delete();

        return redirect()->route('administrator.availableTime')->with('success', 'Available time deleted successfully!');
    }
}
