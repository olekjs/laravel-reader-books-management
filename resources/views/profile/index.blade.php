@extends('layouts.app')

@section('content')
<div class="container">
    <profile :user="{{ $user }}" :statistics="{{ json_encode($user->getStatistics()) }}"></profile>
    <h3>Tablica użytkownika {{ $user->full_name }}</h3>
    <wall :user="{{ $user }}"></wall>
    @foreach($posts as $post)
    	<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<div class="d-inline"><img src="{{ $post->user->profile->photo }}" width="50px" height="50px"></img></div>
				<div class="d-inline" style="font-weight: bold; font-size: 190%;">{{ $post->user->profile->full_name }}</div>
				<hr class="my-4">
				<p class="lead">{{ $post->content }}</p>
				<hr class="my-4">
				<p>Opublikowano: {{ $post->created_at }}</p>
			</div>
		</div>
    @endforeach
    <p>{{ $posts->links() }}</p>
</div>
@endsection
