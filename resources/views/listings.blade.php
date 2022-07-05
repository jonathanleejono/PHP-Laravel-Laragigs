@extends('layout')

{{-- the word 'content' should match the 'content' in layout.blade.php  --}}
{{-- sort of like a React 'root'  --}}
@section('content')

{{-- this is like the "if" statement --}}
@unless(count($listings) == 0)

<!-- can also be written as ?php echo $heading; -->
<!--  -->
<h1>{{$heading}}</h1>
@foreach ($listings as $listing)
    <h2>
        <a href="/listings/{{$listing['id']}}">{{$listing['title']}}</a>
    </h2>
    <p>
        {{$listing['description']}}
    </p>
@endforeach

@else
<p>No listings found</p>
@endunless