@extends('layouts.app')

@section('title') Show Users @endsection

@section('content')

    <div class="row">

        <div class="col-12">

            <x-bread-crumb>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </x-bread-crumb>
            <div class="card">
                <div class="card-body">
                    <h3>
                        <i class="feather-users"></i>
                        User List
                    </h3>



                    <table class="table mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Control</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->is_admin }}</td>
                                    <td>




                                        @if ($user->is_admin == 1)
                                            <form class="d-inline-block"
                                                action="{{ route('admin.makeAdmin.user', $user->id) }}"
                                                id="form{{ $user->id }}" method="POST">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    onclick="adminConfirm({{ $user->id }})">Upgrade
                                                    Admin</button>
                                            </form>


                                            @if ($user->is_banned == 0)
                                                <form class="d-inline-block"
                                                    action="{{ route('admin.ban.user', $user->id) }}"
                                                    id="banForm{{ $user->id }}" method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="userBan({{ $user->id }})">Ban User</button>
                                                </form>

                                            @else

                                                <form class="d-inline-block"
                                                    action="{{ route('admin.unban.user', $user->id) }}"
                                                    id="unbanForm{{ $user->id }}" method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        onclick="userUnban({{ $user->id }})">Unban User</button>
                                                </form>

                                            @endif

                                            {{-- PW Change with Ajax Sweet Alert --}}
                                            <button class="btn btn-sm btn-outline-warning"
                                                onclick="changePassword({{ $user->id }}, '{{ $user->name }}' )">Change
                                                PW</button>


                                            {{-- Password Change with Bootstrap Modal --}}
                                            {{-- @include('admin.password-change') --}}
                                                
                                        @else
                                            Admin Level

                                        @endif


                                    </td>
                                    <td>
                                        <small>
                                            <i class="feather-calendar"></i>
                                            {{ $user->created_at->format("d F Y") }}
                                        </small>
                                        <br>
                                        <small>
                                            <i class="feather-clock"></i>
                                            {{$user->created_at->format("h:i a")}}
                                        </small>
                                        
                                        </td>
                                    <td>{{ $user->updated_at }}</td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>
@endsection


@section('foot')

    <script>
        function adminConfirm(id) {
            Swal.fire({3w
                title: 'Are you sure to upgrade Admin Role?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Upgrade'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'Your role has been upgraded.',
                        'success'
                    )

                    setTimeout(function() {
                        $("#form" + id).submit();
                    }, 2000)
                }


            })


        }

        function userBan(id) {
            Swal.fire({
                title: 'Are you sure to ban User?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ban'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'Now user is banned.',
                        'success'
                    )

                    setTimeout(function() {
                        $("#banForm" + id).submit();
                    }, 2000)
                } 


            })


        }



        function userUnban(id) {
            Swal.fire({
                title: 'Are you sure to unban User?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Unban'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'Now user is unbanned.',
                        'success'
                    )

                    setTimeout(function() {
                        $("#unbanForm" + id).submit();
                    }, 2000)
                }


            })
        }





        // PW Change with Ajax Sweet Alert
        function changePassword(id, name) {

            let url = "{{ route('admin.changePassword.user') }}";

            Swal.fire({
                title: 'Change Password for ' + name,
                input: 'password',
                inputAttributes: {
                    minlength: 6,
                    maxlength: 10,
                    required: 'required'
                },
                showCancelButton: true,
                confirmButtonText: 'Change',
                showLoaderOnConfirm: true,
                preConfirm: function(newPassword) {

                    $.post(url, {
                        id: id,
                        password: newPassword,
                        _token: "{{ csrf_token() }}",

                    }).done(function(data) {

                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                text: data.message,
                            })
                        } else {

                            console.log(data);
                            Swal.fire({
                                icon: 'error',
                                text: data.message.password,
                            })
                        }

                        console.log(data);
                    })
                }
            })
        }
    </script>


@endsection
