@extends('layouts.app')

@section('content')
    <div class="row">
        <div class='col-md-12'>
        @if($posts->count())
            @foreach($posts as $post)
                @include('partials.post')
            @endforeach
        @else
            <div class='jumbotron'>
                <p>No posts to show</p>
            </div>
        @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
        {!!$posts->links()!!}
        </div>
    </div>
@endsection
