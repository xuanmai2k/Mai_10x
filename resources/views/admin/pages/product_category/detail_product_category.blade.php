@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Update Product Category</h2>
        <form action="{{ route('admin.product-category.update',['product_category' => $productCategoryList[0]->id]) }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name category"
                    name="name" value="{{ $productCategoryList[0]->name }}">
            </div>
            @error('name')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" value="{{ $productCategoryList[0]->slug }}">
            </div>
            @error('slug')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Minimum Limit Age:</label>
                <input type="number" class="form-control" id="minimum_limit_age" name="minimum_limit_age" value="{{ $productCategoryList[0]->minimum_limit_age }}">
            </div>
            @error('minimum_limit_age')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Maximum Limit Age:</label>
                <input type="number" class="form-control" id="maximum_limit_age" name="maximum_limit_age" value="{{ $productCategoryList[0]->maximum_limit_age }}">
            </div>
            @error('maximum_limit_age')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Quantity for injection</label>
                <input type="number" class="form-control" id="quantity_for_injection" name="quantity_for_injection" value="{{ $productCategoryList[0]->quantity_for_injection }}">
            </div>
            @error('quantity_for_injection')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option {{ $productCategoryList[0]->status ? 'selected' : '' }} value="1">Show</option>
                    <option {{ (!$productCategoryList[0]->status) ? 'selected' : '' }} value="0">Hide</option>
                </select>
            </div>
            @error('status')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <input type="hidden" name="id" value="{{ $productCategoryList[0]->id }}">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#name').on('keyup', function(){
                let name = $(this).val(); //get value from nam service
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

