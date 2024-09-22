<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class NewCategoryController extends Controller
{

    public function index()
    {
        return view('new-category');
    }

    public function store(Request $request)
    {
        // Doğrulama işlemi
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,name',
        ], [
            'title.required' => 'Category title is required.',
            'title.string' => 'Category title must be a string.',
            'title.max' => 'Category title must not exceed 255 characters.',
            'title.unique' => 'This category title already exists.',
        ]);

        // Yeni kategoriyi veritabanına kaydetme
        Category::create([
            'name' => $request->input('title'),
        ]);

        // Başarılı mesajı ile ana sayfaya yönlendirme
        return redirect('/categories')->with('success', 'Category created successfully!');
    }
}
