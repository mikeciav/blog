@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
        <hr>
            <div class='row'>
                <div 'col-md-8 col-offset-6'>
                    {!!$posts->links()!!}
                </div>
            </div>
    </div>
</div>
@endsection
