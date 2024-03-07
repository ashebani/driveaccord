@props(['user', 'class' => 'w-16 h-16'])
{{--@php--}}
{{--$userPoints = 5; //$user->userPoints();--}}
{{--@endphp--}}
{{--{{($userPoints < 5) ? '' : (($userPoints <= 10) ? 'bronze_border' : (($userPoints <= 20) ? 'silver_border' : 'gold_border'))}}--}}
<img
    alt="Speaker"
    src="{{$user->image_url}}"
    class="rounded-lg object-cover {{$class}} aspect-square"
/>
