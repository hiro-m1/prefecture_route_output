<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SerchRouteForm;

class RouteController extends Controller
{
  public function serch(SerchRouteForm $request) {
    $keywords = $request->input('keyword');

    // キーワードから該当する該当する路線のIDを取得
    $query = DB::table('routes'); 
    $query->select('id');

    if(!empty($keywords)) {
      foreach ($keywords as $keyword) {
          $query->orwhere('route_name','like','%'.$keyword.'%');
      }
    }          
    // SQLログ
    // dump($query->toSql(), $query->getBindings());

    $route_ids = $query->get();

    if(!isset($route_ids[0])) {
      return view('result.station');
    } else {
      // 取得したIDから該当する駅を検索
      $query1 = DB::table('routes');
      $query1->join('stations', 'stations.route_id', '=', 'routes.id');
      $query1->select('routes.id as route_id', 'stations.id as station_id', 'route_name', 'station_name');
      
      $record_no = 0;
 
      foreach($route_ids as $route_id) {
        $record_no = $record_no + 1;
        If($record_no == 1) {
          $query1->where('routes.id', $route_id->id);
        } else {
          $query1->orwhere('routes.id', $route_id->id);        
        }
      }

      $routes = $query1->get();

      return view('result.station', compact('routes'));

    }
  }
}
