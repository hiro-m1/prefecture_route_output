<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StationOutputController extends Controller
{
  public function view(Request $request) {

    // requestを変数に代入
    $form_values = $request->input("station");
    $ret = [];

    // value値の_をスペース区切りに変換
    $form_values = str_replace('_', ' ', $form_values);
    $i = 0;

    // route_idとstation_idを配列に入れる
    foreach($form_values as $form_value) {
        $ret['keyword['.$i.']'] = explode(' ', $form_value);
        $i++;
    }

  // 選択された項目のデータ取得
  $query = DB::table('routes');
  $query->join('stations', 'stations.route_id', '=', 'routes.id');
  $query->select('routes.id as route_id', 'stations.id as station_id', 'route_name', 'station_name');
  foreach($ret as $id => $value) {
      $query->orwhere(function($query) use($value) {
        $query->where('routes.id', $value[0])
              ->where('stations.id', $value[1]);
      });
  }    
    $outputs = $query->get();
    
    $text = '';
    $i = 0;
    $count = count($outputs);
    
    foreach($outputs as $output) {
      $i++;
      if($count == $i) {
        $text = $text.$output->route_name.'【'.$output->station_name.'】';
      } else {
        $text = $text.$output->route_name.'【'.$output->station_name.'】'.'_';
      }
    }
    
    return view('output.station', compact('outputs', 'text'));

  }
}
