@php use Illuminate\Support\Str; @endphp
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

    <x-panel>
        <h2 class="text-xl font-bold">{{__("Most Active Posts")}}</h2>
        @foreach($mostActivePosts as $post)
            <x-posts.post-card
                wire:key="{{$post->id}}"
                :post="$post"/>
        @endforeach
    </x-panel>
    <x-panel>
        <h2 class="text-xl font-bold">{{__('Latest Posts')}}</h2>
        @foreach($latestPosts as $post)
            <x-posts.post-card
                wire:key="{{$post->id}}"
                :post="$post"/>
        @endforeach
    </x-panel>
    <x-panel>
        <h2 class="text-xl font-bold">{{__('Most Helpful Posts')}}</h2>
        @forelse($mostHelpfulPosts as $post)
            <x-posts.post-card
                wire:key="{{$post->id}}"
                :post="$post"/>
        @empty
        @endforelse
    </x-panel>
</div>
