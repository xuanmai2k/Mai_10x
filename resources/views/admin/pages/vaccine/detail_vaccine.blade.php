@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Update Vaccine</h2>
        <form action="{{route('admin.vaccine.update', ['vaccine'=>$vaccineList[0]->id])}}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name_product" placeholder="Enter name vaccine"
                    name="name_product" value="{{ $vaccineList[0]->name_product }}">
            </div>
            @error('name_product')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" value="{{ $vaccineList[0]->slug }}">
            </div>
            @error('slug')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Product category:</label>
                <select name="product_category_id" class="form-select">
                    <option {{ $vaccineList[0]->product_category_id ? 'selected' : '' }}  value="{{ $vaccineList[0]->product_category_id }}">{{ $vaccineList[0]->category->name }}</option>
                    @foreach ($productCategoryList as $productCategory)
                        @continue($productCategory->id == $vaccineList[0]->product_category_id)
                        <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('product_category_id')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Price:</label>
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{ $vaccineList[0]->price }}">
            </div>
            @error('price')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Made in:</label>
                <input type="text" class="form-control" id="made_in" placeholder="Enter made in" name="made_in" value="{{ $vaccineList[0]->made_in }}">
            </div>
            @error('made_in')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Short description:</label>
                <input type="text" class="form-control" id="short_description" placeholder="Enter short description"
                    name="short_description" value="{{ $vaccineList[0]->short_description }}">
            </div>
            @error('short_description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Description:</label>
                <textarea name="description" id="description">{{ $vaccineList[0]->description }}</textarea>
            </div>
            @error('description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Information:</label>
                <input type="text" class="form-control" id="information" placeholder="Enter information"
                    name="information" value="{{ $vaccineList[0]->information }}">
            </div>
            @error('information')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Dosage:</label>
                <input type="number" class="form-control" id="dosage" placeholder="Enter information"
                    name="dosage" value="{{ $vaccineList[0]->dosage }}" step="any" value="0.1">
            </div>
            @error('dosage')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Quantity:</label>
                <input type="number" class="form-control" id="qty" placeholder="Enter quantity" name="qty" value="{{ $vaccineList[0]->qty }}">
            </div>
            @error('qty')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Image:</label>
                <img src="{{ asset('images/admin/vaccine/'.$vaccineList[0]->image_url) }}" width="100px" height="100px">
                <input type="file" class="form-control" id="image_url" name="image_url" value="{{ $vaccineList[0]->image_url }}">
            </div>
            @error('image_url')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option {{ $vaccineList[0]->status ? 'selected' : '' }} value="1">Show</option>
                    <option {{ (!$vaccineList[0]->status) ? 'selected' : '' }} value="0">Hide</option>
                </select>
            </div>
            @error('status')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <input type="hidden" name="id" value="{{ $vaccineList[0]->id }}">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#name_product').on('keyup', function(){
                let name = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.vaccine.slug') }}",
                    data: {
                        name_product: name,
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

@section('description-ckeditor')
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ), {
            ckfinder: {
                uploadUrl: '{{route('admin.product.image.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
            console.error( error );
        });
</script>
@endsection

@section('script-pop-up')

@endsection
