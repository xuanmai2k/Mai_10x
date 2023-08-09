@extends('admin.layout.master')
@section('content')
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-12 stretch-card grid-margin">
                <!-- Contact List -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">Contact List</h2>
                        <div class="form-group" style="margin: 2% 0%">
                            <form  method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search name|phone|email ..." aria-label="Recipient's username" value="{{ is_null(request()->keyword) ? '' : request()->keyword}}">
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
                                        <th class="border-bottom pb-2">Email</th>
                                        <th class="border-bottom pb-2">Phone</th>
                                        <th class="border-bottom pb-2">Content</th>
                                        <th class="border-bottom pb-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contactList as $contact)
                                        <tr>
                                            <td class="pl-0">{{ $loop->iteration }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->content }}</td>
                                            <td>
                                                <form id={{ $contact->id }} method="POST" action="{{ route('admin.contact.changeStatus', ['contact' => $contact->id]) }}">
                                                    @csrf
                                                    <button onclick="myfunction({{ $contact->id }})" type="button" class="btn btn-{{ $contact->status ? 'success' : 'danger' }}" >{{ $contact->status ? 'Complete' : 'Not yet' }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Contact</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{ $contactList->appends(request()->query())->links() }}
                        </div>
                    </div>
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
                confirmButtonText: 'Yes, change it!',
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
