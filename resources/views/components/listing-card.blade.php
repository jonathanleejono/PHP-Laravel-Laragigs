@props(['listing'])

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="images/no-image.png" alt="" />
        <div>
            <h3 class="text-2xl">
                {{-- can be written like this as well --}}
                {{-- <a href="show.html">{{$listing['title']}}</a> --}}
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            {{-- uses the tags in listing-tags.blade.php --}}
            {{-- make sure the x-listing-tags matches the filename listing-tags.blade.php --}}
            <x-listing-tags :tagsCsv="$listing->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>