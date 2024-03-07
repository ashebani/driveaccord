@props(['model'])
@auth
    <div
        x-cloak
        x-data="{isModel{{$model->id}}Selected: false}"
        x-init="isModel{{$model->id}}Selected = {{$model->bookmarks->contains('user_id',auth()->id())}}"
    >
        {{--        If Clicked      --}}
        <button
            wire:click="bookmark({{$model->id}})"
            @click="isModel{{$model->id}}Selected = ! isModel{{$model->id}}Selected"
            class="text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold p-2 rounded transition-colors duration-300"
        >
            <x-jam-bookmark-f
                x-show="isModel{{$model->id}}Selected"
                class="w-6 h-6 dark:fill-white"/>
            <x-jam-bookmark
                x-show="! isModel{{$model->id}}Selected"
                class="w-6 h-6 dark:fill-white"/>
        </button>
    </div>
@endauth
