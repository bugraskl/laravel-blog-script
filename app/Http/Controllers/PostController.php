<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('my-posts', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('edit-post', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        // Doğrulama işlemi
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id', // Kategori seçilmelidir ve valid olmalıdır
            'post' => 'required|string',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Resim doğrulaması
        ], [
            'title.required' => 'Post title is required.',
            'category.required' => 'Please select a category.',
            'category.exists' => 'Selected category is invalid.',
            'post.required' => 'Post content is required.',
            'thumb.image' => 'The thumbnail must be an image.',
            'thumb.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumb.max' => 'The thumbnail size must not exceed 2MB.',
        ]);

        $post = Post::find($id);

        // Eğer yeni bir thumb dosyası yüklenmişse
        if ($request->hasFile('thumb')) {
            // Eski thumb'ı silme işlemi
            if ($post->thumb) {
                Storage::disk('public')->delete($post->thumb); // Eski dosyayı sil
            }

            // Yeni dosyayı yükleme ve kaydetme
            $thumbPath = $request->file('thumb')->store('thumbnails', 'public');
            $post->thumb = $thumbPath;
        }

        // Post'u güncelleme
        $post->title = $request->input('title');
        $post->body = $request->input('post');
        $post->category_id = $request->input('category');

        $post->save();

        return redirect('/my-posts')->with('success', 'Post updated!');
    }



    public function destroy()
    {
        $id = request('id');
        $post = Post::find($id);
        $post->delete();
        return redirect('/my-posts')->with('success', 'Post deleted!');
    }
}
