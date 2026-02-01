@extends('layouts.app')

@section('content')
<div class="contact">
  <h2>Contact</h2>

  {{-- バリデーションエラー（まとめ表示） --}}
  @if ($errors->any())
    <div class="errors">
      <ul>
        @foreach ($errors->all() as $error)
          <li style="color:red;">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ url('/confirm') }}" method="POST">
    @csrf

    {{-- お名前（姓・名） --}}
    <div>
      <label>お名前（姓）※</label>
      <input type="text" name="last_name" value="{{ old('last_name') }}">
      @error('last_name')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>お名前（名）※</label>
      <input type="text" name="first_name" value="{{ old('first_name') }}">
      @error('first_name')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 性別 --}}
    <div>
      <label>性別 ※</label>
      <label>
        <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
        男性
      </label>
      <label>
        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
        女性
      </label>
      <label>
        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
        その他
      </label>
      @error('gender')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- メール --}}
    <div>
      <label>メールアドレス ※</label>
      <input type="text" name="email" value="{{ old('email') }}">
      @error('email')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 電話番号 --}}
    <div>
      <label>電話番号 ※</label>
      <input type="text" name="tel" value="{{ old('tel') }}" placeholder="例）08012345678">
      @error('tel')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 住所 --}}
    <div>
      <label>住所 ※</label>
      <input type="text" name="address" value="{{ old('address') }}">
      @error('address')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- 建物名（任意） --}}
    <div>
      <label>建物名</label>
      <input type="text" name="building" value="{{ old('building') }}">
      @error('building')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- お問い合わせの種類 --}}
    <div>
      <label>お問い合わせの種類 ※</label>
      <select name="category_id">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>
      @error('category_id')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    {{-- お問い合わせ内容 --}}
    <div>
      <label>お問い合わせ内容 ※（120文字以内）</label>
      <textarea name="detail" rows="5">{{ old('detail') }}</textarea>
      @error('detail')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit">確認画面</button>
  </form>
</div>
@endsection
