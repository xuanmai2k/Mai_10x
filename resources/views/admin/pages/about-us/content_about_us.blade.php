@extends('admin.layout.master')
@section('content')

<div class="container" style="height:100%">
    <div>
        <h1 style="margin-bottom:5%">About Us</h1>
        <h4>Content:</h4>
        <div style="margin-bottom:5%">{!! $content[0]['description'] ?? '' !!}</div>
    </div>
    <div class="text-right" style="margin-bottom: 10%">
        <a class="btn btn-inverse-primary btn-fw" href="{{ route('admin.aboutus.create') }}">Create New About Us</a>
    </div>
</div>
@endsection


