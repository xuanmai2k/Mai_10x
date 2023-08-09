@extends('admin.layout.master')
@section('content')
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-12 stretch-card grid-margin">
                <!-- User List -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">User List</h2>
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
                                        <th class="border-bottom pb-2">Date of Birth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($userList as $user)
                                    <tr>
                                        <td class="pl-0">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->dob }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No User</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class=" clearfix">
                            {{ $userList->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
