@php use Illuminate\Support\Str; @endphp
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

    <x-panel>
        <h2 class="text-xl font-bold">Most Active Posts</h2>
        @foreach($mostActivePosts as $post)
            <livewire:components.post-card
                :post="$post"
                wire:key="{{$post->id}}"
            >
        @endforeach
    </x-panel>
    <x-panel>
        <h2 class="text-xl font-bold">Latest Posts</h2>
        @foreach($latestPosts as $post)
            <livewire:components.post-card
                :post="$post"
                wire:key="{{$post->id}}"
            >
        @endforeach
    </x-panel>
    <x-panel>
        <h2 class="text-xl font-bold">Most Helpful Posts</h2>
        @forelse($mostHelpfulPosts as $post)
            <livewire:components.post-card
                :post="$post"
                wire:key="{{$post->id}}"
            >
        @empty
        @endforelse
    </x-panel>
</div>
