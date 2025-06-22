<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7); 
        $categories = Category::all(); 
        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
{
    $query = Contact::with('category');

    // 絞り込み条件（search()と同じ条件を再利用）
    if ($request->filled('keyword')) {
        $keyword = preg_replace('/\s+/u', '', $request->input('keyword'));
        $query->where(function ($q) use ($keyword) {
            $q->whereRaw("REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"])
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->input('gender'));
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->input('category'));
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->input('date'));
    }

    $contacts = $query->get();

    // CSVを返す
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="contacts.csv"',
    ];

    $columns = [
        'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'
    ];

    return new StreamedResponse(function () use ($contacts, $columns) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, $columns);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender_label,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category_label,
                $contact->detail,
            ]);
        }

        fclose($handle);
    }, 200, $headers);
}
        

    public function search(Request $request)
    {
        $query = Contact::with('category');

        // 名前・メールアドレス（部分一致・フルネーム対応）
        if ($request->filled('keyword')) {
            $keyword = preg_replace('/\s+/u', '', $request->input('keyword')); // 空白除去（全角・半角）
        
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw("REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"])
                  ->orWhereRaw("REPLACE(CONCAT(last_name, ' ', first_name), ' ', '') LIKE ?", ["%{$keyword}%"])
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせの種類
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->paginate(7)->appends($request->all());
        $categories = Category::all(); 

        return view('admin', compact('contacts', 'categories'));
    }
    public function destroy($id)
    {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect('/admin');
    }

    public function __construct()
    {
    $this->middleware('auth');
    }
}
