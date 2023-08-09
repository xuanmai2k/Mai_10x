@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Update Holiday</h2>
        <form action="{{ route('admin.holiday.update',['holiday' => $holidayList[0]->id]) }}" role="form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label>Name of date:</label>
                <input type="text" class="form-control" id="name_of_date" placeholder="Enter name of date" name="name_of_date" value="{{ $holidayList[0]->name_of_date }}">
            </div>
            @error('name_of_date')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Dayoff:</label>
                <input type="date" class="form-control" id="dayoff" name="dayoff" value="{{ $holidayList[0]->dayoff }}">
            </div>
            @error('dayoff')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <input type="hidden" name="id" value="{{ $holidayList[0]->id }}">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
