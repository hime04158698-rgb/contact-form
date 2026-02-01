@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <div class="index__content">
    <h2>トップページ</h2>
    <p>ログイン中だけ見えるページです。</p>
  </div>
@endsection
