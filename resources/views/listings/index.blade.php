<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        {{-- this is like the "if" statement --}}
        @unless(count($listings) == 0)

        @foreach ($listings as $listing)
        {{-- use a colon for the prop param --}}
        {{-- the "$listing" is the one above in the brackets --}}
        <x-listing-card :listing="$listing" />
        @endforeach

        @else
        <p>No listings found</p>
        @endunless

    </div>

    <div class="mt-6 p-4">{{$listings->links()}}</div>
</x-layout>