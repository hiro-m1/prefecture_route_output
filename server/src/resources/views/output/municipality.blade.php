@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">検索結果</div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="copyToClipboard()">コピー</button>
            </div>
            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="copyTarget" type="text" value="{{ $text }}" readonly>
          </div>
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
              {{ csrf_field() }}
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">都道府県</th>
                    <th scope="col">市町村区</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($outputs as $output)
                  <tr>
                    <td>
                      {{ $output->prefecture_name }}
                    </td>
                    <td>
                      {{ $output->municipality_name }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
