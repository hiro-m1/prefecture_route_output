<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SerchStationForm;


class StationController extends Controller
{
  public function serch(SerchStationForm $request) {

    $keywords = $request->input('keyword');

    // キーワードから該当する該当する路線のIDを取得
    $query = DB::table('stations'); 
    $query->join('routes', 'stations.route_id', '=', 'routes.id');
    $query->select('routes.id as route_id', 'stations.id as station_id', 'route_name', 'station_name');

    if(!empty($keywords)) {
      foreach ($keywords as $keyword) {
        $query->orwhere('station_name',$keyword);
      }
    }          

    // SQLログ
    // dump($query->toSql(), $query->getBindings());

    $stations = $query->get();    

    return view('result.station', compact('stations'));

  }
}
