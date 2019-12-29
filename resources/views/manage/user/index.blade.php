@extends('layouts/app')

@section('title')
    Manage User
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('User.create')}}">
                            <button class="btn btn-primary">Add User</button>
                        </a>
                        <table class="table table-responsive">
                            <tr >
                                <th>#</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Profile Picture</th>
                                <th>DOB</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $d)
                                <div>
                                    <tr>
                                        <td>{{$count++}}</td>

                                        <td>{{$d->role}}</td>

                                        <td>{{$d->email}}</td>

                                        <td>{{$d->name}}</td>

                                        <td>{{$d->gender}}</td>

                                        <td>{{$d->address}}</td>

                                        <td><img src="/storage/users/{{$d->photo}}" alt="photo" style="width: 100px;height: auto"></td>

                                        <td>{{$d->birthday}}</td>

                                        <td>
                                            <a href="{{ route('User.edit',$d->id) }}">
                                                <button class="btn btn-primary" style="width: 65px">Edit</button>
                                            </a>

                                            <form action="{{ route('User.destroy',$d->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
{{--                                                <input type="hidden" name="_method" value="DELETE">--}}
                                                <button class="btn btn-danger" type="submit" style="width: 65px">Delete</button>
                                            </form>
{{--                                            <a href="{{ route('User.destroy',$d->id) }}">--}}
{{--                                                --}}
{{--                                            </a>--}}
                                        </td>

                                    </tr>
                                </div>
                            @endforeach
                        </table>
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
