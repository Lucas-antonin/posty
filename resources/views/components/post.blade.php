
@props(['post' => $post])
<div class='mb-4'>
    <a href='{{ route('users.posts', $post->user->username) }}' class='font-bold'>{{ $post->user->username }}</a>
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
    <p class="bm-2"> {{ $post->body }} </p>


    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-gradient-to-r from-pink-500 to-yellow-500 text-white px-4 py-3 rounded font-medium">Delete</button>
        </form>
    @endcan

    <div class="flex items-center">
        @auth
            @if(!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post->id) }}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class='text-blue-500'>Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class='text-blue-500'>Unlike</button>
                </form>
            @endif




        @endauth
        <span> {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}</span>
    </div>
</div>
