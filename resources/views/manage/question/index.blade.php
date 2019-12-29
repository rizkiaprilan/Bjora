@extends('layouts/app')

@section('title')
    Manage Question
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('Question.create')}}">
                            <button class="btn btn-primary">Add Question</button>
                        </a>
                        <table class="table table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Topic</th>
                                <th>Owner</th>
                                <th class="col-lg-3">Question</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $d)
                                <div>
                                    <tr>
                                        <td>{{$count++}}</td>

                                        <td>{{$d->topic}}</td>

                                        <td>{{$d->name}}</td>

                                        <td>{{$d->question}}</td>

                                        <td>{{$d->status}}</td>

                                        <td>
                                            <div class="row">
                                                @if($d->status == 'open')
                                                    <a href="/Question/{{$d->id}}/switchstatus">
                                                        <button class="btn" style="background: lawngreen;width: 65px">
                                                            Open
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="/Question/{{$d->id}}/switchstatus">
                                                        <button class="btn" style="background: orange;width: 65px">
                                                            Closed
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="{{ route('Question.edit',$d->id) }}">
                                                    <button class="btn btn-primary" style="width: 65px">Edit</button>
                                                </a>

                                                <form action="{{ route('Question.destroy',$d->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit" style="width: 65px">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
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
