@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Holiday</h2>
        <form action="{{ route('admin.holiday.store') }}" role="form" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <label>Name of date:</label>
                <input type="text" class="form-control" id="name_of_date" placeholder="Enter name of date" name="name_of_date">
            </div>
            @error('name_of_date')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Dayoff:</label>
                <input type="date" class="form-control" id="dayoff" name="dayoff">
            </div>
            @error('dayoff')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
