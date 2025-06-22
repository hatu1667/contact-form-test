@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@php
  $contact = request()->has('from_confirm') ? session('contact_input', []) : [];
@endphp

<section class="form-section">
  <h2>Contact</h2>
  <form class="form" action="/confirm" method="post">
    @csrf

    {{-- 姓・名 --}}
<div class="form-row">
  <label>お名前 <span>*</span></label>
  <div class="form-columns">
    <div class="form-field">
      <input type="text" name="last_name" placeholder="例：山田"
        value="{{ old('last_name', $contact['last_name'] ?? '') }}">
      @error('last_name') <div class="form-error">{{ $message }}</div> @enderror
    </div>
    <div class="form-field">
      <input type="text" name="first_name" placeholder="例：太郎"
        value="{{ old('first_name', $contact['first_name'] ?? '') }}">
      @error('first_name') <div class="form-error">{{ $message }}</div> @enderror
    </div>
  </div>
</div>

    {{-- 性別 --}}
    <div class="form-row">
      <label>性別 <span>*</span></label>
      <div class="form-inline">
        <label class="custom-radio">
          <input type="radio" name="gender" value="1"
            {{ old('gender', $contact['gender'] ?? '1') == '1' ? 'checked' : '' }}>
          <span class="radio-icon"></span> 男性
        </label>
        <label class="custom-radio">
          <input type="radio" name="gender" value="2"
            {{ old('gender', $contact['gender'] ?? '') == '2' ? 'checked' : '' }}>
          <span class="radio-icon"></span> 女性
        </label>
        <label class="custom-radio">
          <input type="radio" name="gender" value="3"
            {{ old('gender', $contact['gender'] ?? '') == '3' ? 'checked' : '' }}>
          <span class="radio-icon"></span> その他
        </label>
      </div>
      @error('gender') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    {{-- メールアドレス --}}
    <div class="form-row">
  <label>メールアドレス <span>*</span></label>
  <div class="form-field">
    <input type="email" name="email" placeholder="例：test@example.com"
      value="{{ old('email', $contact['email'] ?? '') }}">
    @error('email') <div class="form-error">{{ $message }}</div> @enderror
  </div>
</div>

    {{-- 電話番号 --}}
<div class="form-row">
  <label>電話番号 <span>*</span></label>
  <div class="form-columns phone">
    <div class="form-field">
      <input type="text" name="tel1" placeholder="080"
        value="{{ old('tel1', $contact['tel1'] ?? '') }}">
      @error('tel1') <div class="form-error">{{ $message }}</div> @enderror
    </div>
    <div class="form-field">
      <input type="text" name="tel2" placeholder="1234"
        value="{{ old('tel2', $contact['tel2'] ?? '') }}">
      @error('tel2') <div class="form-error">{{ $message }}</div> @enderror
    </div>
    <div class="form-field">
      <input type="text" name="tel3" placeholder="5678"
        value="{{ old('tel3', $contact['tel3'] ?? '') }}">
      @error('tel3') <div class="form-error">{{ $message }}</div> @enderror
    </div>
  </div>
</div>


    {{-- 住所 --}}
    <div class="form-row">
  <label>住所 <span>*</span></label>
  <div class="form-field">
    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
      value="{{ old('address', $contact['address'] ?? '') }}">
    @error('address') <div class="form-error">{{ $message }}</div> @enderror
  </div>
</div>

<div class="form-row">
  <label>建物名</label>
  <div class="form-field">
    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101"
      value="{{ old('building', $contact['building'] ?? '') }}">
  </div>
</div>


    {{-- お問い合わせの種類 --}}
    <div class="form-row">
  <label>お問い合わせの種類 <span>*</span></label>
  <div class="form-field">
    <select name="category_id">
      <option value="">選択してください</option>
      <option value="1" {{ old('category_id', $contact['category_id'] ?? '') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
      <option value="2" {{ old('category_id', $contact['category_id'] ?? '') == '2' ? 'selected' : '' }}>商品の交換について</option>
      <option value="3" {{ old('category_id', $contact['category_id'] ?? '') == '3' ? 'selected' : '' }}>商品トラブル</option>
      <option value="4" {{ old('category_id', $contact['category_id'] ?? '') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
      <option value="5" {{ old('category_id', $contact['category_id'] ?? '') == '5' ? 'selected' : '' }}>その他</option>
    </select>
    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
  </div>
</div>

    {{-- お問い合わせ内容 --}}
    <div class="form-row">
  <label>お問い合わせ内容 <span>*</span></label>
  <div class="form-field">
    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $contact['detail'] ?? '') }}</textarea>
    @error('detail') <div class="form-error">{{ $message }}</div> @enderror
  </div>
</div>

    <div class="form-submit">
      <button type="submit">確認画面</button>
    </div>
  </form>
</section>
@endsection
