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
    <div class='row'>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- sidebar -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-8326042738973131"
             data-ad-slot="1357297602"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <div class="row">
        <div class="col-md-4 col-centered">
        {!!$posts->links()!!}
        </div>
    </div>
@endsection
