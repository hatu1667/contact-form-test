@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <section class="form-section">
      <h2>Confilm</h2>

      <form class="form" action="/thanks" method="post">
        @csrf

        <div class="confirm-row">
  <label>お名前</label>
  <input type="text" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly>
  <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
  <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
</div>

<div class="confirm-row">
  <label>性別</label>
  <input type="text" value="{{ $contact['gender_label'] }}" readonly>
  <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
</div>

<div class="confirm-row">
  <label>メールアドレス</label>
  <input type="email" value="{{ $contact['email'] }}" readonly>
  <input type="hidden" name="email" value="{{ $contact['email'] }}">
</div>

<div class="confirm-row">
  <label>電話番号</label>
  <input type="text" value="{{ $contact['tel1'] }}-{{ $contact['tel2'] }}-{{ $contact['tel3'] }}" readonly>
  <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
  <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
  <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
</div>

<div class="confirm-row">
  <label>住所</label>
  <input type="text" value="{{ $contact['address'] ?? '' }}" readonly>
  <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
</div>

<div class="confirm-row">
  <label>建物名</label>
  <input type="text" value="{{ $contact['building'] }}" readonly>
  <input type="hidden" name="building" value="{{ $contact['building'] }}">
</div>

<div class="confirm-row">
  <label>お問い合わせの種類</label>
  <input type="text" value="{{ $contact['category'] }}" readonly>
  <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
</div>

<div class="confirm-row">
  <label>お問い合わせ内容</label>
  <textarea readonly>{{ $contact['detail'] }}</textarea>
  <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
</div>

<div class="button-group">
  <button type="submit">送信</button>
  <a href="{{ route('contact.index', ['from_confirm' => 1]) }}" class="button-link">修正</a>
</div>
</form>



</section>
@endsection