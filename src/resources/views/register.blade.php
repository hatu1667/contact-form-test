<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
  <a href="/login" class="login-link">login</a>
  </header>

  <main class="main">
    <h2 class="title">Register</h2>
    <div class="form-box">
      <form class="form-inner" method="POST" action="{{ route('register') }}">
        @csrf

        <div>
          <label for="name">お名前</label>
          <input type="text" id="name" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}">
          @error('name')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="email">メールアドレス</label>
          <input type="email" id="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
          @error('email')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" placeholder="例：coachtec1106">
          @error('password')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-submit">
          <button type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
