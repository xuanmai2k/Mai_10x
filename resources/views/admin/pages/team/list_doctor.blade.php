@extends('admin.layout.master')
@section('content')
<div class="container" style="margin-bottom: 2%" >
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <!-- Doctor List -->
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-0">Doctor List</h2>
                    <div class="form-group" style="margin: 2% 0%">
                        <form  method="GET">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search name ..." aria-label="Recipient's username" value="{{ is_null(request()->keyword) ? '' : request()->keyword}}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="pl-0  pb-2 border-bottom">#</th>
                                    <th class="border-bottom pb-2">Name</th>
                                    <th class="border-bottom pb-2">Slug</th>
                                    <th class="border-bottom pb-2">Email</th>
                                    <th class="border-bottom pb-2">Phone</th>
                                    <th class="border-bottom pb-2">Position</th>
                                    <th class="border-bottom pb-2">Short_information</th>
                                    <th class="border-bottom pb-2">Image</th>
                                    <th class="border-bottom pb-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctorList as $doctor)
                                    <tr>
                                        <td class="pl-0">{{ $loop->iteration }}</td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->slug }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>{{ $doctor->position }}</td>
                                        <td>{{ $doctor->short_information }}</td>
                                        <td>
                                            @php
                                                $imageLink = is_null($doctor->image_url) || !file_exists('images/admin/doctor/' . $doctor->image_url) ? 'default-image.jpg' : $doctor->image_url;
                                            @endphp
                                            <img src="{{ asset('images/admin/doctor/'.$imageLink) }}" alt="{{ $doctor->name }}" width="150" height="150" >
                                        </td>
                                        <td>
                                            <form id={{ $doctor->id }} method="POST" action="{{ route('admin.doctor.destroy', ['doctor' => $doctor->id]) }}">
                                                @csrf
                                                @method("DELETE")
                                                <a href="{{ route('admin.doctor.show', [ $doctor->id]) }}" class="btn btn-primary">Edit</a>
                                                <button onclick="myfunction({{ $doctor->id }})" type="button" class="btn btn-danger">Delete</button>
                                            </form>
                                            @if($doctor->trashed())
                                                <form action="{{ route('admin.doctor.restore', ['doctor' => $doctor->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Restore</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Doctor</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix">
                        {{ $doctorList->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @if (session('message') == "success")
            <script>
                Swal.fire(
                    'Success!',
                    'You clicked the button!',
                    'success'
                );
            </script>
        @endif
        @if(session('message') == "failed")
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
                });
            </script>
            @endif
        <div class="container">
            <div class="text-right">
                <a class="btn btn-inverse-primary btn-fw" href="{{ route('admin.doctor.create') }}">Create New Doctor</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-pop-up')
<script>
    // Lắng nghe sự kiện click trên nút alert
    function myfunction(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(id)?.submit()
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    };
</script>
@endsection
