@extends('layouts.app')

@section('content')
<div class="thanks">
  <h2>Thank you</h2>
  <p>お問い合わせありがとうございました</p>

  <a href="{{ url('/') }}">HOME</a>
</div>
@endsection
