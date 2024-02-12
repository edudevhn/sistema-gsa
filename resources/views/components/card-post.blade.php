@props(['post'])
<article class="mb-4 bg-white shado-lg rounded-lg overflow-hidden">
    <img class="w-full h-80 object-cover object-center" src="@if($post->image) {{ Storage::url($post->image->url) }} @else https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg @endif" alt="">

    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show',$post)}}">{{$post->name}}</a>
        </h1>

        <div class="text-gray-700 text-base ">
            {!!$post->extract!!}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
        <a href="{{route('posts.tag',$tag)}}" class="inline-block bg-gray-200 rounded-full px-3 py-1 
        text-sm text-gray-700 mr-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>