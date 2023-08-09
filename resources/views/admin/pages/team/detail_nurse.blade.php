@extends('admin.layout.master')
@section('content')
    <div class="container mt-3" style="margin-bottom: 2%">
        <h2>Update Nurse</h2>
        <form action="{{ route('admin.nurse.update',['nurse' => $nurseList[0]->id]) }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name nurse" name="name" value="{{ $nurseList[0]->name }}">
            </div>
            @error('name')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Slug:</label>
                <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug"
                    value="{{ $nurseList[0]->slug }}">
            </div>
            @error('slug')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $nurseList[0]->email }}">
            </div>
            @error('email')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Phone:</label>
                <input type="tel" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{ $nurseList[0]->phone }}">
            </div>
            @error('phone')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ $nurseList[0]->dob }}">
            </div>
            @error('dob')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Position:</label>
                <input type="text" class="form-control" id="position" placeholder="Enter position" name="position" value="{{ $nurseList[0]->position }}">
            </div>
            @error('position')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Short_information:</label>
                <input type="text" class="form-control" id="short_information" placeholder="Enter short information"
                    name="short_information" value="{{ $nurseList[0]->short_information }}">
            </div>
            @error('short_information')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Information:</label>
                <textarea name="information" id="information" >{{ $nurseList[0]->information }}</textarea>
            </div>
            @error('information')
                <span style="color:red">{{ $message }}</span>
            @enderror
            <div class="mb-3 mt-3">
                <label>Image:</label>
                <img src="{{ asset('images/admin/nurse/'.$nurseList[0]->image_url) }}" width="100px" height="100px">
                <input type="file" class="form-control" id="image_url" name="image_url" value="{{ $nurseList[0]->image_url }}">
            </div>
            <input type="hidden" name="id" value="{{ $nurseList[0]->id }}">
            <button type="submit" class="btn btn-primary">Update</button>
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
                    url: "{{ route('admin.nurse.slug') }}",
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
