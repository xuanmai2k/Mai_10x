@extends('admin.layout.master')
@section('content')
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-12 stretch-card grid-margin">
                <!-- Vaccine List -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">Vaccine List</h2>
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
                                    <select name="sort" id="sort" style="margin-top: 2%" class="btn btn-inverse-primary btn-fw btn-sm">
                                        <option @if(request()->sort === '0') selected @endif value="0">Lastest</option>
                                        <option @if(request()->sort === '1') selected @endif value="1">Price Low to High</option>
                                        <option @if(request()->sort === '2') selected @endif value="2">Price High to Low</option>
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
                                        <th class="border-bottom pb-2">Product category</th>
                                        <th class="border-bottom pb-2">Price</th>
                                        <th class="border-bottom pb-2">Made in</th>
                                        <th class="border-bottom pb-2">Dosage</th>
                                        <th class="border-bottom pb-2">Quantity</th>
                                        <th class="border-bottom pb-2">Image</th>
                                        <th class="border-bottom pb-2">Status</th>
                                        <th class="border-bottom pb-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vaccineList as $vaccine)
                                        <tr>
                                            <td class="pl-0">{{ $loop->iteration }}</td>
                                            <td>{{ $vaccine->name_product }}</td>
                                            <td>{{ $vaccine->slug }}</td>
                                            <td>{{ $vaccine->category->name }}</td>
                                            <td>{{ $vaccine->price }}</td>
                                            <td>{{ $vaccine->made_in }}</td>
                                            <td>{{ $vaccine->dosage }} ml</td>
                                            <td>{{ $vaccine->qty }}</td>
                                            <td>
                                                @php
                                                    $imageLink = is_null($vaccine->image_url) || !file_exists('images/admin/vaccine/' . $vaccine->image_url) ? 'default-image.jpg' : $vaccine->image_url;
                                                @endphp
                                                <img src="{{ asset('images/admin/vaccine/'.$imageLink) }}" alt="{{ $vaccine->name_product }}" width="150" height="150" >
                                            </td>
                                            <td>
                                                <a class="btn btn-{{ $vaccine->status ? 'success' : 'danger' }}">{{ $vaccine->status ? 'show' : 'hide' }}</a>
                                            </td>
                                            <td>
                                                <form id={{ $vaccine->id }} method="POST"
                                                    action="{{ route('admin.vaccine.destroy', ['vaccine' => $vaccine->id]) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <a href="{{ route('admin.vaccine.show', [ $vaccine->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <button onclick="myfunction({{ $vaccine->id }})" type="button"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                                @if($vaccine->trashed())
                                                    <form action="{{ route('admin.vaccine.restore', ['vaccine' => $vaccine->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Restore</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Vaccine</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{ $vaccineList->appends(request()->query())->links() }}
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
                    <a class="btn btn-inverse-primary btn-fw" href="{{ route('admin.vaccine.create') }}">Create New Vaccine</a>
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

