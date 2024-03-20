<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-panel>
        @foreach($categories as $category)
            <article
                wire:key="{{$category->id}}">

                <x-card-panel
                    class="p-4 sm:p-4">
                    <div class="grid sm:flex sm:justify-between w-full items-center gap-4">
                        <a
                            wire:navigate
                            class="md:mr-10 rtl:md:mr-0 rtl:sm:text-right "
                            href="/makes/{{$category->id}}">
                            <div>
                                <h3 class="text-lg text-center sm:text-left rtl:sm:text-right font-bold lg:text-xl ">{{$category->name}}</h3>
                                <p class="text-md text-center sm:text-left rtl:sm:text-right">{{__($category->description)}}</p>
                            </div>
                        </a>
                        <div class="grid md:flex md:justify-start items-center space-y-2 md:space-y-0 md:space-x-8">
                            <div class="flex space-x-4 sm:justify-self-end justify-around items-center">
                                <div class="grid md:flex md:space-x-2">
                                    {{--                                    <x-iconoir-post class="h-5 w-5 mx-auto md:h-6 md:w-6 text-gray-500 stroke-gray-500"/>--}}
                                    <p class="text-sm desc-text mt-1 md:mt-0">
                                        {{$category->posts_count}} Posts
                                    </p>
                                </div>
                                <div class="grid md:flex md:space-x-2">
                                    {{-- <x-jam-write class="h-5 w-5 fill-gray-500 md:h-6 md:w-6"/>--}}
                                    {{--                                    <x-go-people-24 class="h-5 w-5 fill-gray-500 mx-auto md:h-6 md:w-6"/>--}}
                                    <p class="text-sm desc-text mt-1 md:mt-0">
                                        {{$category->post_contributers}}
                                        Contributions
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 text-center md:text-right hidden lg:block">Last
                                    updated {{$category->post_last_updated}}
                                </p>
                            </div>
                            <p class="text-sm text-gray-600 text-center md:text-right sm:hidden">Last
                                updated {{$category->post_last_updated}}
                            </p>
                        </div>
                    </div>
                </x-card-panel>
            </article>
        @endforeach
    </x-panel>
</div>


