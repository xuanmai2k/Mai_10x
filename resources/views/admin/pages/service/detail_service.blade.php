@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Update Service</h2>
        <form action="{{ route('admin.service.update',['service' => $serviceList[0]->id]) }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name service"
                    name="name" value="{{ $serviceList[0]->name }}">
            </div>
            @error('name')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" value="{{ $serviceList[0]->slug }}">
            </div>
            @error('slug')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Price:</label>
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{ $serviceList[0]->price }}">
            </div>
            @error('price')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Short description:</label>
                <input type="text" class="form-control" id="short_description" placeholder="Enter short description"
                    name="short_description" value="{{ $serviceList[0]->short_description }}">
            </div>
            @error('short_description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Description:</label>
                <textarea name="description" id="description" >{{ $serviceList[0]->description }}</textarea>
            </div>
            @error('description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Image:</label>
                <img src="{{ asset('images/admin/service/'.$serviceList[0]->image_url) }}" width="100px" height="100px">
                <input type="file" class="form-control" id="image_url" name="image_url" value="{{ $serviceList[0]->image_url }}">
            </div>
            @error('image_url')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option {{ $serviceList[0]->status ? 'selected' : '' }} value="1">Show</option>
                    <option {{ (!$serviceList[0]->status) ? 'selected' : '' }} value="0">Hide</option>
                </select>
            </div>
            @error('status')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <input type="hidden" name="id" value="{{ $serviceList[0]->id }}">
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
                    url: "{{ route('admin.service.slug') }}",
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

@section('description-ckeditor')
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '{{ route('admin.service.image.upload') . '?_token=' . csrf_token() }}',
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

@section('script-pop-up')

@endsection

