<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
    return view('login'); // login.blade.php を返す
    }
    
    public function store(LoginRequest $request)
    {
        // バリデーション済みデータを取得
        $credentials = $request->validated();

        // 認証処理
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => '認証に失敗しました。もう一度お試しください。',
        ])->withInput();
    }
}
