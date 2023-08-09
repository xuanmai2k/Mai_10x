@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Blog</h2>
        <form action="{{ route('admin.blog.store') }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name blog"
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
                <label>Short description:</label>
                <input type="text" class="form-control" id="short_description" placeholder="Enter short description"
                    name="short_description">
            </div>
            @error('short_description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Description:</label>
                <textarea name="description" id="description" ></textarea>
            </div>
            @error('description')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Image:</label>
                <input type="file" class="form-control" id="image_url" name="image_url">
            </div>
            @error('image_url')
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
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                let name = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.blog.slug') }}",
                    data: {
                        name: name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $('#slug').val(res.slug);
                    },
                    error: function(res) {

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
                uploadUrl: '{{route('admin.blog.image.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
            console.error( error );
        });
</script>
@endsection


@section('script-pop-up')

@endsection
