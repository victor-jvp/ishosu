@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<section class="content">
    @if(Session::has("info"))
    <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        {{ Session::get("info") }}
    </div>
    @endif
</section>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
