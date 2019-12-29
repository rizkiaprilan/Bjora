@extends('layouts/app')

@section('title')
    Manage Topic
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('Topic.create')}}">
                            <button class="btn btn-primary">Add Topic</button>
                        </a>
                        <table class="table table-responsive" >
                            <tr>
                                <th>#</th>
                                <th class="col-lg-6">Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $d)
                                <div>
                                    <tr>
                                        <td>{{$count++}}</td>

                                        <td>{{$d->topic}}</td>

                                        <td>
                                            <a href="{{ route('Topic.edit',$d->id) }}">
                                                <button class="btn btn-primary" style="width: 65px">Edit</button>
                                            </a>

                                            <form action="{{ route('Topic.destroy',$d->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" style="width: 65px">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
