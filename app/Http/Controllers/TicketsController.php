<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('user.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tickets.create');
    }
    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        return view('user.tickets.user_tickets', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'problem_description' => 'required',
        ]);
        $ticket = new Ticket([
            'user_id' => Auth::user()->id,
            'ticket_id' => Str::random(7),
            'problem_description' => $request->input('problem_description'),
            'status' => "Open"
        ]);
        $ticket->save();
        //$mailer->sendTicketInformation(Auth::user(), $ticket);
        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::where('ticket_id', $id)->firstOrFail();
        return view('user.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
