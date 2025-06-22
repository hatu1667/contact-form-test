<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="admin-header">
    <h1>FashionablyLate</h1>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="logout-link">logout</button>
    </form>
  </header>

  <main class="admin-main">
    <h2 class="admin-title">Admin</h2>

    <div class="admin-container">
      <!-- 一段目 -->
      <div class="admin-search-block">
        <form class="admin-search-form" action="/admin/search" method="GET">
          <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

          <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>

          <select name="category">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
            @endforeach
          </select>

          <input type="date" name="date" value="{{ request('date') }}">
          <button type="submit" class="search-btn">検索</button>
          <a href="/admin" class="reset-btn">リセット</a>
        </form>
      </div>

      <!-- 二段目 -->
      <div class="admin-toolbar">
        <form method="GET" action="{{ route('admin.export') }}">
          <input type="hidden" name="keyword" value="{{ request('keyword') }}">
          <input type="hidden" name="gender" value="{{ request('gender') }}">
          <input type="hidden" name="category" value="{{ request('category') }}">
          <input type="hidden" name="date" value="{{ request('date') }}">
          <button type="submit" class="export-btn">エクスポート</button>
        </form>
        <div class="pagination-wrapper">
          {{ $contacts->links() }}
        </div>
      </div>

      <!-- テーブル -->
      <table class="admin-table">
        <thead>
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($contacts as $contact)
          <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->gender_label }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category_label }}</td>
            <td>
              <button type="button" class="detail-btn btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                data-id="{{ $contact->id }}"
                data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                data-gender="{{ $contact->gender_label }}"
                data-email="{{ $contact->email }}"
                data-tel="{{ $contact->tel }}"
                data-address="{{ $contact->address }}"
                data-building="{{ $contact->building }}"
                data-category="{{ $contact->category_label }}"
                data-detail="{{ $contact->detail }}">
                詳細
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>

<!-- 詳細モーダル -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content custom-modal-content">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
        </div>
        <div class="modal-body">
          <table class="modal-detail-table">
            <tr><th>お名前</th><td id="modal-name"></td></tr>
            <tr><th>性別</th><td id="modal-gender"></td></tr>
            <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
            <tr><th>電話番号</th><td id="modal-tel"></td></tr>
            <tr><th>住所</th><td id="modal-address"></td></tr>
            <tr><th>建物名</th><td id="modal-building"></td></tr>
            <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
            <tr><th>お問い合わせ内容</th><td id="modal-detail" style="white-space: pre-wrap;"></td></tr>
          </table>
          <div class="text-center mt-4">
            <form method="POST" id="modal-delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger custom-delete-btn">削除</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const detailButtons = document.querySelectorAll('.detail-btn');

      detailButtons.forEach(button => {
        button.addEventListener('click', function () {
          document.getElementById('modal-name').textContent = this.dataset.name;
          document.getElementById('modal-gender').textContent = this.dataset.gender;
          document.getElementById('modal-email').textContent = this.dataset.email;
          document.getElementById('modal-tel').textContent = this.dataset.tel;
          document.getElementById('modal-address').textContent = this.dataset.address;
          document.getElementById('modal-building').textContent = this.dataset.building;
          document.getElementById('modal-category').textContent = this.dataset.category;
          document.getElementById('modal-detail').textContent = this.dataset.detail;

          document.getElementById('modal-delete-form').action = `/admin/${this.dataset.id}`;
        });
      });
    });
  </script>
</body>
</html>

