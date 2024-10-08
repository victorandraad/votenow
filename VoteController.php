<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Question;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Events\VoteUpdated;
use Illuminate\Support\Facades\Log;
use App\Events\MensagemEnviada;

class VoteController extends Controller
{
    public  function sendMessage(Request $request) {
        $mensagem = $request->input('mensagem', 'olá galeriinha!');
        broadcast(new MensagemEnviada($mensagem));

        return response()->json(['yteste' => 'Mensagem enviada']);
    }
    public function enterRoom()
    {
        return view('votes.enter_room');
    }

    public function joinRoom(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:rooms,code'
        ]);

        $room = Room::where('code', $request->code)->firstOrFail();
        return redirect()->route('votes.room', $room->code);
    }

    public function showRoom($code)
    {
        $room = Room::where('code', $code)->firstOrFail();
        $questions = $room->questions()->with('options')->get();
        return view('votes.room', compact('room', 'questions'));
    }

    public function castVote(Request $request, Question $question)
    {
        $request->validate([
            'option_id' => 'required|exists:options,id'
        ]);

        $ip_address = $request->ip();

        // Check if the user has already voted on this question
        $existingVote = Vote::where('question_id', $question->id)
                            ->where('ip_address', $ip_address)
                            ->exists();

        // if ($existingVote) {
        //     return back()->with('error', 'You have already voted on this question.');
        // }

        Vote::create([
            'option_id' => $request->option_id,
            'question_id' => $question->id,
            'ip_address' => $ip_address
        ]);

        return redirect()->route('rooms.result', $question->room->code);
    }
}
