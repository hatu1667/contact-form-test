<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
    <a href="/register" class="auth-link">register</a>
  </header>

  <main>
    <h2 class="title">Login</h2>
    <div class="login-box">
      <form action="{{ route('login') }}" method="POST" class="login-form">
        @csrf
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
          @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" placeholder="例: coachtech1106">
          @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="submit">
          <button type="submit">ログイン</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>


