@extends('admin.layout.master')
@section('content')
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-12 stretch-card grid-margin">
                <!-- Holiday List -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">Holiday List</h2>
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
                                        <th class="border-bottom pb-2">Name of Day</th>
                                        <th class="border-bottom pb-2">Dayoff</th>
                                        <th class="border-bottom pb-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($holidayList as $holiday)
                                    <tr>
                                        <td class="pl-0">{{ $loop->iteration }}</td>
                                        <td>{{ $holiday->name_of_date }}</td>
                                        <td>{{ $holiday->dayoff }}</td>
                                        <td>
                                            <form id={{ $holiday->id }} method="POST" action="{{ route('admin.holiday.destroy', ['holiday' => $holiday->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('admin.holiday.show', [$holiday->id]) }}" class="btn btn-primary">Edit</a>
                                                <button onclick="myfunction({{ $holiday->id }})" type="button" type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Holiday</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{ $holidayList->appends(request()->query())->links() }}
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
                    <a class="btn btn-inverse-primary btn-fw" href="{{ route('admin.holiday.create') }}">Create New Holiday</a>
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
