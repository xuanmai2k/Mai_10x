@extends('admin.layout.master')
@section('content')
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-12 stretch-card grid-margin">
                <!-- Blog List -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">Blog List</h2>
                        <div class="form-group" style="margin: 2% 0%">
                            <form  method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search name ..." aria-label="Recipient's username" value="{{ is_null(request()->keyword) ? '' : request()->keyword}}" >
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                                <div>
                                    <select name="status" id="status" style="margin-top: 2%" class="btn btn-inverse-primary btn-fw btn-sm">
                                        <option @if(request()->status === '') selected @endif value="">--Select All--</option>
                                        <option @if(request()->status === '1') selected @endif value="1">--Show--</option>
                                        <option @if(request()->status === '0') selected @endif value="0">--Hide--</option>
                                    </select>
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
                                        <th class="border-bottom pb-2">Short description</th>
                                        <th class="border-bottom pb-2">Image</th>
                                        <th class="border-bottom pb-2">Status</th>
                                        <th class="border-bottom pb-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogList as $blog)
                                        <tr>
                                            <td class="pl-0">{{ $loop->iteration }}</td>
                                            <td>{{ $blog->name }}</td>
                                            <td>{{ $blog->slug }}</td>
                                            <td>{{ $blog->short_description }}</td>
                                            <td>
                                                @php
                                                    $imageLink = is_null($blog->image_url) || !file_exists('images/admin/blog/' . $blog->image_url) ? 'default-image.jpg' : $blog->image_url;
                                                @endphp
                                                <img src="{{ asset('images/admin/blog/'.$imageLink) }}" alt="{{ $blog->name }}" width="150" height="150" >
                                            </td>
                                            <td>
                                                <a class="btn btn-{{ $blog->status ? 'success' : 'danger' }}">{{ $blog->status ? 'show' : 'hide' }}</a>
                                            </td>
                                            <td>
                                                <form id={{ $blog->id }} method="POST" action="{{ route('admin.blog.destroy', ['blog' => $blog->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.blog.show', [ $blog->id]) }}" class="btn btn-primary">Edit</a>
                                                    <button onclick="myfunction({{ $blog->id }})" type="button" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Blog</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="clearfix">
                                {{ $blogList->appends(request()->query())->links() }}
                            </div>
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
                    <a class="btn btn-inverse-primary btn-fw" href="{{ route('admin.blog.create') }}">Create New Blog</a>
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
