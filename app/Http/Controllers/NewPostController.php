<?php

namespace App\Http\Controllers;

use App\Jobs\SendPostToSubscribers;
use App\Models\Post;
use Illuminate\Http\Request;

class NewPostController extends Controller
{

    public function index()
    {
        return view('new-post');
    }

    public function store(Request $request)
    {
        // Doğrulama işlemi
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'post' => 'required|string',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Post title is required.',
            'category.required' => 'Please select a category.',
            'category.exists' => 'Selected category is invalid.',
            'post.required' => 'Post content is required.',
            'thumb.image' => 'The thumbnail must be an image.',
            'thumb.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumb.max' => 'The thumbnail size must not exceed 2MB.',
        ]);

        if ($request->hasFile('thumb')) {
            $thumbPath = $request->file('thumb')->store('thumbnails', 'public');
        } else {
            $thumbPath = null;
        }

        // Yeni postu veritabanına kaydetme
        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('post'),
            'category_id' => $request->input('category'),
            'user_id' => auth()->id(),
            'thumb' => $thumbPath,
        ]);


        $postUrl = url('/posts/' . $post->id);
        SendPostToSubscribers::dispatch($postUrl);

        // Başarılı mesajı ile yönlendirme
        return redirect('/')->with('success', 'Post created successfully!');
    }
}
