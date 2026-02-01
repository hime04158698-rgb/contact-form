<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;   // ← 作る（バリデーション用）
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせフォーム入力画面  GET /
     * - categories をDBから取ってきてプルダウンに渡す
     * - 「修正」で戻ってきた時のために old() を使って view 側で復元する
     */
    public function create()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    /**
     * 確認画面  POST /confirm
     * - バリデーション（FormRequest）
     * - 確認画面に入力値を渡す
     */
    public function confirm(ContactRequest $request)
    {
        // フォームで入力された値（バリデーション後）
        $data = $request->validated();

        // ★ ここを追加（2行だけ）
        $category = Category::find($data['category_id']);
        $data['category_content'] = $category ? $category->content : '';

        // 確認画面へ
        return view('contact.confirm', compact('data'));
    }

    /**
     * DB保存 → サンクスへ  POST /thanks
     * - confirm 画面の「送信」から来る想定
     * - DBに保存して、thanks へリダイレクト
     */
    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        // contactsテーブルに保存
        Contact::create($data);

        // 二重送信防止のため、GET /thanks にリダイレクト
        return redirect('/thanks');
    }

    /**
     * サンクスページ  GET /thanks
     */
    public function thanks()
    {
        return view('contact.thanks');
    }

    /**
     * 管理画面（一覧・検索） GET /admin  ※auth必須（routes側）
     * - あなたが既に作っていた検索・paginateをここに置く
     */
    public function index(Request $request)
    {
        // セレクト用（カテゴリ）
        $categories = Category::all();

        // 一覧用（categoryも一緒に取得）
        $query = Contact::with('category');

        // キーワード（姓・名・フルネーム・メール）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 種別（category_id）
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付（created_at）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ずつ + 検索条件を保持
        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin.index', compact('contacts', 'categories'));
    }

    // ※ 応用（後で実装でOK）
    // public function export(Request $request) {}
    // public function show(Contact $contact) {}
    // public function destroy(Contact $contact) {}
}
