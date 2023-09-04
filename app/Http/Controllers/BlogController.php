<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Contracts\Pagination\Paginator;

class BlogController extends Controller
{
    public function index() : Paginator | View
    {
        $posts = Post::with('tags','category')->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug,Post $post) : RedirectResponse | View
    {
        if($post->slug != $slug)
        {
            return to_route('blog.show', ['slug' => $post->slug,'post' => $post->id]);
        }

        return view('blog.show',compact('post'));
    }

    public function create()
    {
        $post = new Post();

        $categories = Category::select('id','name')->get();
        $tags = Tag::select('id','name')->get();
        return view('blog.create', compact('post','categories','tags'));
    }

    public function store(CreatePostRequest $request)
    {
        $post = Post::create($this->extractData(new Post(),$request));

        return redirect()->route('blog.show', ['slug' => $post->slug , 'post' => $post->id])->with('success', "L'article a été sauvegarder avec success");
    }

    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id','name')->get(),
            'tags' => Tag::select('id','name')->get()
        ]);
    }

    public function update(Post $post, CreatePostRequest $request)
    {
        $post->update($this->extractData($post,$request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.show', ['slug' => $post->slug , 'post' => $post->id])->with('success', "L'article a été modifier avec success");

    }

    private function extractData(Post $post, CreatePostRequest $request): array
    {
        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if($image == null || $image->getError())
        {
            return $data;
        }

        if($post->image)
        {
            Storage::disk('public')->delete($post->image);
        }

        $data['image'] = $image->store('blog','public');
        return $data;
    }
}
