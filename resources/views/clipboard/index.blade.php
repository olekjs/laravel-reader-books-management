@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @foreach($items as $item)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $item->book->photo }}" class="clipboard-photo-settings" />
                            </div>
                            <div class="col-md-8">
                                <p><strong style="font-size: 120%;"></strong></p>
                                <h3>{{ $item->book->title }}</h3>
                                <hr class="my-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Autor: {{ $item->book->author }}</p>
                                        <p>Kategoria: {{ $item->book->category }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Epoka: {{ $item->book->epochs }}</p>
                                        <p>ISBN: {{ $item->book->isbn }}</p>
                                        <p>Liczba stron: {{ $item->book->number_pages }}</p>
                                    </div>
                                </div>
                                <clipboard :item="{{ $item->id }}" :notes="{{ json_encode($item->notes) }}" :bookmark="{{ json_encode($item->bookmark) }}" :status="{{ $item->status }}"></clipboard>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card mt-2 mb-2">
                <div class="card-body">
                    <p class="text-center">{{ $items->links() }}</p>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
