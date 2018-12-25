@extends('layouts.app')

@section('content')
<div class="container">
    <profile :user="{{ $user }}" :statistics="{{ json_encode($user->getStatistics()) }}"></profile>
</div>
@endsection
