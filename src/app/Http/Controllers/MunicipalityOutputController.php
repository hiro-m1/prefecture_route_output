<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipalities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MunicipalityOutputController extends Controller
{

  public function view(Request $request) {

    // requestを変数に代入
    $form_values = $request->input("municipality");
    $ret = [];

    // value値の_をスペース区切りに変換
    $form_values = str_replace('_', ' ', $form_values);
    $i = 0;

    // prefecture_idとmunicipality_idを配列に入れる    
    foreach($form_values as $form_value) {
      $ret['keyword['.$i.']'] = explode(' ', $form_value);    
      $i++;
    }
    
      // 選択された項目のデータ取得
      $query = DB::table('municipalities');
      $query->join('prefectures', 'municipalities.prefecture_id', '=', 'prefectures.id');
      $query->select('prefectures.id as prefecture_id', 'municipalities.id as municipality_id', 'prefecture_name', 'municipality_name');
    
      foreach($ret as $id => $value) {
        $query->orwhere(function($query) use($value) {
          $query->where('prefectures.id', $value[0])
          ->where('municipalities.id', $value[1]);
        });
      }    

      $outputs = $query->get();

      $text = '';
      $i = 0;
      $count = count($outputs);
      
      foreach($outputs as $output) {
        $i++;
        if($count == $i) {
          $text = $text.$output->prefecture_name.'【'.$output->municipality_name.'】';
        } else {
          $text = $text.$output->prefecture_name.'【'.$output->municipality_name.'】'.'_';
        }
      }

      return view('output.municipality', compact('outputs', 'text'));

    }
}
