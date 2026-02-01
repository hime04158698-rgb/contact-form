@extends('layouts.app')

@section('content')
<div class="confirm">
  <h2>Confirm</h2>

  <table border="1" cellpadding="8">
    <tr>
      <th>お名前</th>
      <td>{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
    </tr>
    <tr>
      <th>性別</th>
      <td>
        @php
          $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'];
        @endphp
        {{ $genderText[(string)$data['gender']] ?? '' }}
      </td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td>{{ $data['email'] }}</td>
    </tr>
    <tr>
      <th>電話番号</th>
      <td>{{ $data['tel'] }}</td>
    </tr>
    <tr>
      <th>住所</th>
      <td>{{ $data['address'] }}</td>
    </tr>
    <tr>
      <th>建物名</th>
      <td>{{ $data['building'] ?? '' }}</td>
    </tr>
    <tr>
      <th>お問い合わせの種類</th>
      <td>
        {{-- category_id から表示名を出したい場合は、ここはあとで改善できます。
             まずはIDのままでも動きます。 --}}
        {{ $data['category_content'] }}

      </td>
    </tr>
    <tr>
      <th>お問い合わせ内容</th>
      <td>{!! nl2br(e($data['detail'])) !!}</td>
    </tr>
  </table>

  {{-- 送信（DB保存） --}}
  <form action="{{ url('/thanks') }}" method="POST" style="display:inline;">
    @csrf
    {{-- 入力値を全部 hidden で持ち回す --}}
    @foreach ($data as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit">送信</button>
  </form>

  {{-- 修正：入力画面に戻る（値を保持したいので withInput() が必要） --}}
  <form action="{{ url('/') }}" method="GET" style="display:inline;">
    <button type="submit">修正</button>
  </form>
</div>
@endsection
