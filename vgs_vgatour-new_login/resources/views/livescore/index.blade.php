@extends('layout.app')
@section('title', $tour->name)
@section('content')
<div style="float: left; margin-top: 20px; width: 1220px; ">
    @if($tour->link_livescore != null)
        <iframe frameborder="0" width="100%" height="<?=getLiveScoreSize($tourId);?>px" scrolling="no"
                src="{{$tour->link_livescore}}" width="100%"></iframe>
    @else
        <h3>Coming soon</h3>
    @endif
</div>
@endsection
@push('style_head')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endpush
