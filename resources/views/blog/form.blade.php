<form action="" method="POST" class="vstack gap-2" enctype="multipart/form-data">
    @csrf
    @method($post->id ? 'PATCH' : 'POST')
    <div>
        <input class="form-control mt-3" type="file" name="image">
        @error('image')
            <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div>
        <input class="form-control mt-3" type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Article de démonstration">
        @error('title')
            <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div>
        <input class="form-control mt-3" type="text" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Slug de démonstration">
        @error('slug')
            <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div>
        <textarea class="form-control mt-3" name="content" id="" cols="30" rows="10" placeholder="Content">{{ old('content', $post->content) }}</textarea>
        @error('content')
        <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div>
        <select name="category_id" class="form-control" id="category_id">
            <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $category)
            <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>

            @endforeach

        </select>
        @error('category_id')
        <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    @php
        $tagsIds = $post->tags()->pluck('id');
    @endphp
    <div>
        <select name="tags[]" class="form-control" id="tag" multiple>
            @foreach ($tags as $tag)
            <option  @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>

            @endforeach

        </select>
        @error('tags')
        <span class="text text-danger">{{ $message }}</span>
        @enderror

    </div>
    <button class="btn btn-success mt-3" type="submit">@if($post->id) Modifier @else Enregistrer @endif</button>
</form>
