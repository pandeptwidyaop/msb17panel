<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\TicketAccess;
use Auth;
use Session;
use App\Http\Requests\VoteAccessPostRequest;

class TicketAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [];
      $ticket = TicketAccess::select('tickets.number','tickets.unique_number','users.name')
        ->join('tickets','tickets.unique_number','=','ticket_accesses.unique_number')
        ->join('users','users.id','=','ticket_accesses.user_id')
        ->get();
      $ta = TicketAccess::all();
      foreach ($ta as $key) {
        $data[] = $key->unique_number;
      }
      $t = Ticket::whereNotIn('unique_number',$data)->get();
      return view('ticket.access.index',compact('ticket','t'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoteAccessPostRequest $request)
    {
        $ta = new TicketAccess;
        $ta->unique_number = $request->unique_number;
        $ta->user_id = Auth::user()->id;
        if ($ta->save()) {
          Session::flash('alert','Berhasil menambah akses tiket.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menambah akses tiket.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url(Auth::user()->role.'/ticketaccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
      $ticket = TicketAccess::where('unique_number',$id);
      if ($ticket->delete()) {
        Session::flash('alert','Berhasil menghapus tiket.');
        Session::flash('alert-class','alert-success');
      }else{
        Session::flash('alert','Gagal menghapus tiket.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect(url(Auth::user()->role.'/ticketaccess'));

    }
}
