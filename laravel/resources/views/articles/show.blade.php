@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
    <div class="container">
        @include('articles.card')
    </div>
@endsection
