@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Product Category</h2>
        <form action="{{ route('admin.product-category.store') }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name service"
                    name="name">
            </div>
            @error('name')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug">
            </div>
            @error('slug')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Minimum Limit Age:</label>
                <input type="number" class="form-control" id="minimum_limit_age" name="minimum_limit_age">
            </div>
            @error('minimum_limit_age')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Maximum Limit Age:</label>
                <input type="number" class="form-control" id="maximum_limit_age" name="maximum_limit_age">
            </div>
            @error('maximum_limit_age')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Quantity for injection</label>
                <input type="number" class="form-control" id="quantity_for_injection" name="quantity_for_injection">
            </div>
            @error('quantity_for_injection')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                </select>
            </div>
            @error('status')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#name').on('keyup', function(){
                let name = $(this).val(); //get value from name service
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.product-category.slug') }}",
                    data: {
                        name: name, // key: value
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res){
                        $('#slug').val(res.slug);
                 },
                 error: function(res){

                 }

                });
            });
        });
    </script>
@endsection

@section('script-pop-up')

@endsection

