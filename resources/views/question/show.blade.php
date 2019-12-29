@extends('layouts/app')

@section('title')
    Show All Questions
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($data as $d)
                            <table class="table table-responsive table-bordered">
                                <tr class="table-borderless">
                                    <td colspan="2">
                                        <b>{{{$d->topic}}}</b>&nbsp;
                                        @if($d->status == 'open')
                                            <a href="/MyQuestion/{{$d->id}}/switchstatus">
                                                <button class="btn" style="background: lawngreen">
                                                    {{$d->status}}
                                                </button>
                                            </a>
                                        @else
                                            <a href="/MyQuestion/{{$d->id}}/switchstatus">
                                                <button class="btn" style="background: orange">
                                                    {{$d->status}}
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="table-borderless">
                                    <td colspan="3">
                                        <span style="font-size: 25px">{{$d->question}}</span>
                                    </td>
                                </tr>
                                <tr class="table-borderless">
                                    <td>
                                        <img src="/storage/users/{{$d->user->photo}}" alt="Image"
                                             style="width: 100px; height: auto">
                                    </td>
                                    <td>
                                        <ul style="list-style: none">
                                            <li>
                                                {{$d->name}}
                                            </li>
                                            <li>
                                                <b>Created at: </b>{{$d->created_at}}
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                                <tr class="table-borderless">
                                    <td colspan="2">
                                        <a href="{{$d->id}}/answer">
                                            <button class="btn btn-primary">
                                                See Answer
                                            </button>
                                        </a>
                                        <a href="/MyQuestion/{{$d->id}}/edit">
                                            <button class="btn btn-warning">
                                                Edit
                                            </button>
                                        </a>
                                        <a href="/MyQuestion/{{$d->id}}/delete">
                                            <button class="btn btn-danger">
                                                Delete
                                            </button>
                                        </a>

                                    </td>

                                </tr>
                            </table>
                        @endforeach
                        @if($data->count() == 0)
                            <label class="text-danger">You don't have any question yet</label>
                        @endif
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
