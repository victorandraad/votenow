<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = auth()->user()->rooms;
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

        $room = auth()->user()->rooms()->create([
            'name' => $request->name,
            'code' => Str::random(6),
        ]);

        return redirect()->route('rooms.show', $room)->with('success', 'Room created successfully');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function addQuestionForm(Room $room)
    {
        return view('rooms.add_question', compact('room'));
    }

    public function addQuestion(Request $request, Room $room)
    {
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

        return redirect()->route('rooms.show', $room)->with('success', 'Question added successfully');
    }

    public function deleteRoom(Room $room)
    {
        $this->authorize('delete', $room);
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }

    public function deleteQuestion(Question $question)
    {
        $this->authorize('delete', $question->room);
        $room = $question->room;
        $question->delete();
        return redirect()->route('rooms.show', $room)->with('success', 'Question deleted successfully');
    }

    public function deleteOption(Option $option)
    {
        $this->authorize('delete', $option->question->room);
        $question = $option->question;
        $option->delete();
        return redirect()->route('rooms.show', $question->room)->with('success', 'Option deleted successfully');
    }
}
