@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@foreach($friends as $friend)
				@foreach($friend->posts as $post)
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<div class="d-inline"><img src="{{ $friend->profile->photo }}" width="50px" height="50px"></img></div>
							<div class="d-inline" style="font-weight: bold; font-size: 190%;">{{ $friend->profile->full_name }}</div>
							<hr class="my-4">
							<p class="lead">{{ $post->content }}</p>
							<hr class="my-4">
							<p>Opublikowano: {{ $post->created_at }}</p>
						</div>
					</div>
				@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection
