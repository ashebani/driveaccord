@props(['model'])
@auth
    <div
        x-cloak
        x-data="{isModelSelected: false}"
        x-init="isModelSelected = '{{$model->bookmarks->contains('user_id',auth()->id())}}'"
    >
        {{--        If Clicked      --}}
        <button
            wire:click="bookmark({{$model->id}})"
            @click="isModelSelected = ! isModelSelected"
            class="text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold p-2 rounded transition-colors duration-300"
        >
            <x-jam-bookmark-f
                x-show="isModelSelected"
                class="w-6 h-6 dark:fill-white"/>
            <x-jam-bookmark
                x-show="! isModelSelected"
                class="w-6 h-6 dark:fill-white"/>
        </button>
    </div>
@endauth
