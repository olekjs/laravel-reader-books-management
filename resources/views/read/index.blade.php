@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			{!! nl2br(e($text)) !!}
		</div>
	</div>
</div>
@endsection
