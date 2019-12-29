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
                            <table class="table">
                                <tr>
                                    <td rowspan="3">
                                        <img src="/storage/Users/{{$d->userSender->photo}}" alt="Image"
                                             style="width: 150px; height: auto; border-radius: 5%;"></td>
                                    </td>
                                    <td>
                                        <a href="/MyQuestion/{{$d->userSender->id}}/viewprofile"
                                           style="text-decoration: none;">{{$d->userSender->name}}</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"><a
                                                href="/MyQuestion/{{$d->id}}/destroymessage"
                                                style="text-decoration: none; color: white">Remove</a>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Posted at: </b> {{$d->created_at}}</td>

                                </tr>
                                <tr>
                                    <td>
                                        <b>Message: </b> {{$d->message}}
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        @if($data->count() == 0)
                            <b class="text-danger">You Don't Have Any Message Yet</b>
                        @endif

                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
