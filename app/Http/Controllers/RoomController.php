<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Add this line at the top of your class

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Auth::user()->rooms;
        return view('rooms.index', compact('rooms'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:rooms,code'
        ]);

        $room = Room::where('code', $request->code)->firstOrFail();
        return view('rooms.show', compact('room'));
    }

    public function seeResult($code)
    {
        $room = Room::where('code', $code)->firstOrFail();
        $questions = $room->questions()->with(['options' => function ($query) {
            $query->withCount('votes');
        }])->get();
        return view('rooms.result', compact('room', 'questions'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $room = Auth::user()->rooms()->create([
            'name' => $request->name,
            'code' => Str::random(6),
        ]);

        return redirect()->route('rooms.add_question', $room->code)->with('success', 'Room created successfully');
    }

    public function show($room_code)
    {
        $room = Room::where('code', $room_code)->firstOrFail();
        return view('rooms.show', compact('room'));
    }

    public function addQuestionForm($room_code)
    {
        $room = Room::where('code', $room_code)->firstOrFail();
        return view('rooms.add_question', compact('room'));
    }

    public function addQuestion(Request $request, $room_code)
    {
        $room = Room::where('code', $room_code)->firstOrFail();
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'image' => 'nullable|url',
            'options' => 'required|array|min:2',
            'options.*.option' => 'required|string|max:255',
        ]);

        $question = $room->questions()->create([
            'question' => $validatedData['question'],
            'image' => $validatedData['image'],
        ]);

        foreach ($validatedData['options'] as $optionData) {
            $question->options()->create([
                'option' => $optionData['option'],
            ]);
        }

        return redirect()->route('rooms.show', $room->code)->with('success', 'Question added successfully');
    }

    public function deleteRoom($room_code)
    {
        $room = Room::where('code', $room_code)->firstOrFail();
        if (Gate::denies('delete', $room)) {
            abort(403); // Handle unauthorized access
        }

        $questions = $room->questions;
        foreach ($questions as $question) {
            $question->options()->delete();
            $question->votes()->delete();
            $question->delete();
        }
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }

    public function deleteQuestion($question_id)
    {
        $question = Question::findOrFail($question_id);
        if (Gate::denies('delete', $question->room)) {
            abort(403); // Handle unauthorized access
        }
        $room = $question->room;
        $question->delete();
        return redirect()->route('rooms.show', $room->code)->with('success', 'Question deleted successfully');
    }

    public function deleteOption($option_id)
    {
        $option = Option::findOrFail($option_id);
        if (Gate::denies('delete', $option->question->room)) {
            abort(403); // Handle unauthorized access
        }
        $question = $option->question;
        $option->delete();
        return redirect()->route('rooms.show', $question->room)->with('success', 'Option deleted successfully');
    }
}
