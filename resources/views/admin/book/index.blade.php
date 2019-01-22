@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					Szukaj książki
				</div>
			</div>
			@foreach($books as $book)
				<div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $book->photo }}" class="clipboard-photo-settings" />
                            </div>
                            <div class="col-md-8">
                                <p><strong style="font-size: 120%;"></strong></p>
                                <h3>{{ $book->title }}</h3>
                                <hr class="my-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Autor: {{ $book->author }}</p>
                                        <p>Kategoria: {{ $book->category }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Epoka: {{ $book->epochs }}</p>
                                        <p>ISBN: {{ $book->isbn }}</p>
                                        <p>Liczba stron: {{ $book->number_pages }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			@endforeach
			<p>{{ $books->links() }}</p>
		</div>
	</div>
</div>
@endsection
