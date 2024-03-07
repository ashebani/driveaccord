@php
    use Illuminate\Support\Str;
$points = 1;
@endphp

<div class="max-w-7xl pb-12 mx-auto sm:px-6 lg:px-8 mt-4 grid">
    <!-- component -->
    <div class="flex flex-col justify-center items-center">

        <div
            class="relative flex flex-col items-center rounded-[10px] border-[1px] border-gray-200 w-full mx-auto p-4 bg-white bg-clip-border shadow-md shadow-[#F3F3F3] dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
            <img
                class="justify-center rounded-xl w-full size-fit h-28"
                src='https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/banner.ef572d78f29b0fee0a09.png'
            >

            {{--            <div class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center rounded-full bg-white p-1 {{($points < 5) ? '' : (($points <= 10) ? 'bronze_border' : (($points <= 20) ? 'silver_border' : 'gold_border'))}}">--}}
            {{--                <x-image-card :user="$user"/>--}}
            {{--            </div>--}}
            <div class="flex flex-col items-center">
                <h4 class="text-xl font-bold text-navy-700 dark:text-white">
                    {{ $user->name }}
                </h4>

                <p class="text-base font-normal text-gray-600">Product Manager</p>

            </div>

            <div class="mt-4 mb-3 flex gap-14 md:!gap-14">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">{{ $user->posts->count() }}</p>
                    <p class="text-sm font-normal text-gray-600">
                        {{ Str::plural('Post', $user->posts->count()) }}</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">
                        {{ $user->comments->count() }}
                    </p>
                    <p class="text-sm font-normal text-gray-600">
                        {{ Str::plural('Comment', $user->comments->count()) }}</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">
                        {{ $points }}
                    </p>
                    <p class="text-sm font-normal text-gray-600">
                        {{ Str::plural('Points', $points) }}</p>
                </div>
            </div>

            <div class="mt-6 ">
                <p class="text-xl">
                    {{$user->name }} has solved problems
                    {{--                    {{ $countOfSolvedPosts }}--}}
                </p>

            </div>
        </div>

    </div>

</div>
