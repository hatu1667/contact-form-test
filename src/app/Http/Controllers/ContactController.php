<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('from_confirm') && session()->has('contact_input')) {
            return view('index')->with('contact', session('contact_input'));
        }
        
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();

        $contact['tel'] = $contact['tel1'] . '-' . $contact['tel2'] . '-' . $contact['tel3'];

        // 性別ラベル定義
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        $contact['gender_label'] = $genderLabels[(int) $contact['gender']] ?? '不明';
        
        $contact['building'] = $request->input('building');


        // カテゴリラベル定義
        $categoryLabels = [
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他',
        ];
        $contact['category'] = $categoryLabels[(int) $contact['category_id']] ?? '不明';

        session(['contact_input' => $contact]);

        return view('confirm', ['contact' => $contact]);
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->validated();

        $contact['tel'] = $contact['tel1'] . '-' . $contact['tel2'] . '-' . $contact['tel3'];

        Contact::create([
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tel' => $contact['tel'],
            'address' => $contact['address'],
            'building' => $contact['building'],
            'category_id' => $contact['category_id'],
            'detail' => $contact['detail'],
        ]);

        session()->forget('contact_input');

        return view('thanks');
    }
}

