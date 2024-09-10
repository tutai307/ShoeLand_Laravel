<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);

        // Thêm lệnh sắp xếp theo mã tăng dần
        $query->orderBy('code', 'asc');

        $events = $query->paginate($perPage);

        return view('admin.events.index', compact('events'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:events,code',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:today',
            'description' => 'nullable|string',
        ]);

        $event = new Event();
        $event->id = (string) Str::uuid();
        $event->name = $request->input('name');
        $event->code = $request->input('code');
        $event->discount = $request->input('discount');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->description = $request->input('description');

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('admin.events.index')->with('msg', 'Sự kiện đã được thêm thành công.');
    }

    public function update(Request $request, Event $event)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:events,code,' . $event->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
        ]);

        // Update the event with the validated data
        $event->name = $request->input('name');
        $event->code = $request->input('code');
        $event->discount = $request->input('discount');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->description = $request->input('description');

        // Check if an image is uploaded and handle the file upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            // Store the new image
            $event->image = $request->file('image')->store('events', 'public');
        }

        // Save the updated event to the database
        $event->save();

        // Redirect back to the events index with a success message
        return redirect()->route('admin.events.index')->with('msg', 'Sự kiện đã được cập nhật thành công.');
    }


    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('msg', 'Sự kiện đã được xóa thành công.');
    }
}
