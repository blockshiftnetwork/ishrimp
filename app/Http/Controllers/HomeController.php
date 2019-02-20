<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pool;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');

        // $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $team_id = auth()->user()->currentTeam->id;
        $pools = Pool::where('team_id', $team_id)->get();
        return view('home')->with(['pools' => $pools]);
    }
}
