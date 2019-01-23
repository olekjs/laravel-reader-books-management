@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@foreach($users as $user)
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<div class="d-inline"><img src="{{ $user->photo }}" width="50px" height="50px"></img></div>
						<div class="d-inline" style="font-weight: bold; font-size: 150%;">{{ $user->full_name }}</div>
						<hr class="my-4">
						<p>Miasto: {{ $user->city }}</p>
						<p class="lead">Opis użytkownika</p>
						<div>{{ $user->about_me }}</div>
					</div>
				</div>
			@endforeach
			<p>{{ $users->links() }}</p>
		</div>
	</div>
</div>
@endsection
