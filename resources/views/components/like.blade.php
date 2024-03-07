@props(['model'])
@auth
    <div
        x-cloak
        x-data="{is{{$model->id}}Liked: false}"
        x-init="is{{$model->id}}Liked = {{$model->likes->contains('user_id',auth()->id())}}"
    >
        {{--        If Clicked      --}}
        <button
            wire:click="like({{$model->id}})"
            @click="is{{$model->id}}Liked = ! is{{$model->id}}Liked"
            class="text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold p-2 rounded transition-colors duration-300"
        >
            <x-ri-heart-2-fill
                x-show="is{{$model->id}}Liked"
                class="w-6 h-6 dark:fill-gray-100"/>

            <x-ri-heart-2-line
                x-show="! is{{$model->id}}Liked"
                class="w-6 h-6 dark:fill-gray-100"/>

        </button>
    </div>
@endauth
