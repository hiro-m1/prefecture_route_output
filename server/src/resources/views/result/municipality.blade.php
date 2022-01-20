@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">検索結果</div>
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form action="{{ url('/output/municipality')}}" method="post" enctype="multipart/form-data" class="form-group" name="form">
              {{ csrf_field() }}
              <p><button type="submit" class="btn btn-primary">出力</button></p>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" style="width:15%"><input type="checkbox" name="all" aria-label="Checkbox for following text input" onClick="AllMunicipalityChecked();"> 全て選択</th>
                    <th scope="col">都道府県</th>
                    <th scope="col">市町村区</th>
                  </tr>
                </thead>
                <tbody>
                  @if (!empty($prefectures))
                  @foreach ($prefectures as $prefecture)
                  <tr>
                    <th scope="row" style="width:15%">
                     <input type="checkbox" name="municipality[]" value="{{ $prefecture->prefecture_id }}_{{ $prefecture->municipality_id }}" aria-label="Checkbox for following text input" onClick="DisChecked();">
                    </th>
                    <td>
                      {{ $prefecture->prefecture_name }}
                    </td>
                    <td>
                      {{ $prefecture->municipality_name }}
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              <p><button type="submit" class="btn btn-primary">出力</button></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
