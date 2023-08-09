@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%" >
        <h2>Doctor</h2>
        <form action="{{ route('admin.doctor.store') }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name doctor" name="name">
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
                <label>Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            @error('email')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Phone:</label>
                <input type="tel" class="form-control" id="phone" placeholder="Enter phone" name="phone">
            </div>
            @error('phone')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
            @error('dob')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Position:</label>
                <input type="text" class="form-control" id="position" placeholder="Enter position" name="position">
            </div>
            @error('position')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Short_information:</label>
                <input type="text" class="form-control" id="short_information" placeholder="Enter short information"
                    name="short_information">
            </div>
            @error('short_information')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Information:</label>
                <textarea name="information" id="information" ></textarea>
            </div>
            @error('information')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Image:</label>
                <input type="file" class="form-control" id="image_url" name="image_url" name="information">
            </div>
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
                    url: "{{ route('admin.doctor.slug') }}",
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
            .create( document.querySelector( '#information' ), {
                ckfinder: {
                    uploadUrl: '{{route('admin.doctor.image.upload').'?_token='.csrf_token()}}',
                }
            })
            .catch( error => {
                console.error( error );
            });
    </script>
@endsection
