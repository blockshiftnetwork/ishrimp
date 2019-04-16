<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pool;
use App\PoolSowing;
use App\DaylySample;
use App\DaylyParameters;
use Illuminate\Support\Facades\DB;
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
        $pools = DB::table('pools')->where('team_id','=', $team_id)
                    ->join('pools_sowing as sowing', 'pools.id','=', 'sowing.pool_id' )
                    ->leftJoin('daily_samples as samples', 'pools.id','=', 'samples.pool_id' )
                    ->leftJoin('daily_parameters as parameters', 'pools.id','=', 'parameters.pool_id' )
                    ->select('pools.id as pool_id', 'pools.name as name', 'sowing.planted_at as planted_at', 'samples.abw as abw', 'samples.wg as awg','samples.survival_percent as survival',
                        DB::raw('(DATEDIFF(CURDATE(),sowing.planted_at)) as days'),'sowing.planted_larvae',
                        DB::raw('(SELECT SUM(pools_resources_used.quantity) FROM pools_resources_used, resources WHERE pools_resources_used.pool_id = pools.id and pools_resources_used.resource_id = resources.id and resources.category_id = 1 ) as balanced'), 'parameters.ppm as do')
                    ->get();
                   dd($pools);
        return view('home')->with(['pools' => $pools]);
    }
}
