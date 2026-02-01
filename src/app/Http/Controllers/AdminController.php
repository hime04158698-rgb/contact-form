<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Contact::with('category');

        // キーワード（名前 or メール）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付（例：created_at の日付で絞る）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(10)->appends($request->query());

        return view('admin.index', compact('categories', 'contacts'));
    }

}
