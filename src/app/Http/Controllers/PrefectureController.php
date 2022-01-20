<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SerchPrefectureForm;

class PrefectureController extends Controller
{

  public function serch(SerchPrefectureForm $request) {

    $keywords = $request->input('keyword');

    // キーワードから該当する該当する路線のIDを取得
    $query = DB::table('prefectures'); 
    $query->select('id');
    
    if(!empty($keywords)) {
      foreach ($keywords as $keyword) {
        $query->orwhere('prefecture_name','like','%'.$keyword.'%');
      }
    }          
    
    // SQLログ    
    // dump($query->toSql(), $query->getBindings());
    
    $prefecture_ids = $query->get();
  
    if(!isset($prefecture_ids[0])) {
      return view('result.municipality');
    } else {
      // 取得したIDから該当する駅を検索
      $query1 = DB::table('prefectures');
      $query1->join('municipalities', 'municipalities.prefecture_id', '=', 'prefectures.id');
      $query1->select('prefectures.id as prefecture_id', 'municipalities.id as municipality_id', 'prefecture_name', 'municipality_name');

      $record_no = 0;
      
      foreach($prefecture_ids as $prefecture_id) {
        $record_no = $record_no + 1;
        If($record_no == 1) {
          $query1->where('prefectures.id', $prefecture_id->id);
        } else {
          $query1->orwhere('prefectures.id', $prefecture_id->id);        
        }
      }
      
      $prefectures = $query1->get();
      
      return view('result.municipality', compact('prefectures'));
      
    }
  }
}
