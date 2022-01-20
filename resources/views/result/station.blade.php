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
            <form action="{{ url('/output/station')}}" method="post" enctype="multipart/form-data" class="form-group" name="form">
              {{ csrf_field() }}
              <p><button type="submit" class="btn btn-primary">出力</button></p>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" style="width:15%"><input type="checkbox" name="all" aria-label="Checkbox for following text input" onClick="AllStationChecked();"> 全て選択</th>
                    <th scope="col">路線名</th>
                    <th scope="col">駅名</th>
                  </tr>
                </thead>
                <tbody>
                  @if (!empty($routes))
                  @foreach ($routes as $route)
                  <tr>
                    <th scope="row" style="width:15%">
                     <input type="checkbox" name="station[]" value="{{ $route->route_id }}_{{ $route->station_id }}" aria-label="Checkbox for following text input" onClick="DisStationChecked();">
                    </th>
                    <td>
                      {{ $route->route_name }}
                    </td>
                    <td>
                      {{ $route->station_name }}
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if (!empty($stations))
                  @foreach ($stations as $station)
                  <tr>
                    <th scope="row" style="width:15%">
                     <input type="checkbox" name="station[]" value="{{ $station->route_id }}_{{ $station->station_id }}" aria-label="Checkbox for following text input" onClick="DisStationChecked();">
                    </th>
                    <td>
                      {{ $station->route_name }}
                    </td>
                    <td>
                      {{ $station->station_name }}
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
