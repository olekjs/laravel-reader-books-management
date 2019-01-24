@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@foreach($friends as $friend)
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<div class="d-inline"><img src="{{ $friend->photo }}" width="50px" height="50px"></img></div>
						<div class="d-inline" style="font-weight: bold; font-size: 150%;">{{ $friend->full_name }}</div>
						<hr class="my-4">
						<p>Miasto: {{ $friend->city }}</p>
						<p class="lead">Opis użytkownika</p>
						<div>{{ $friend->about_me }}</div>
						<hr class="my-4">
						<p>
							<a href="" class="btn btn-primary">Pokaż profil</a>
						</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
