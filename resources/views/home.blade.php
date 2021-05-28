@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
    @if(session("info"))
    <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        {{ session("info") }}
    </div>
    @endif
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
