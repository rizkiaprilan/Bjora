@extends('layouts/app')

@section('title')
    Answer Question
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <tr class="table-borderless">
                                <td>
                                    <b>{{$data->topic}}</b>
                                </td>
                                <td>
                                    @guest()

                                    @else
                                        @if(Auth::user()->id == $data->user_id)
                                            @if($data->status == 'open')
                                                <a href="/MyQuestion/{{$data->id}}/switchstatus">
                                                    <button class="btn" style="background: lawngreen">
                                                        {{$data->status}}
                                                    </button>
                                                </a>
                                            @else
                                                <a href="/MyQuestion/{{$data->id}}/switchstatus">
                                                    <button class="btn" style="background: orange">
                                                        {{$data->status}}
                                                    </button>
                                                </a>
                                            @endif
                                        @endif
                                    @endguest
                                </td>
                            </tr>
                            <tr class="table-borderless">
                                <td colspan="3">
                                    <div style="text-align: justify">

                                        <span style="font-size: 25px">{{$data->question}}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-borderless">
                                <td>
                                    <img src="/storage/users/{{$data->user->photo}}" alt="Image"
                                         style="width: 100px; height: auto">
                                </td>
                                <td>
                                    <ul style="list-style: none">
                                        <li>
                                            <a href="/MyQuestion/{{$data->user->id}}/viewprofile" style="text-decoration: none">
                                                {{$data->name}}
                                            </a>
                                        </li>
                                        <li>
                                            <b>Created at: </b>{{$data->created_at}}
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        </table>
                        <div class="card-body">
                            <table class="">
                                @foreach($answer as $a)
                                    <tr class="table-borderless">
                                        <td>
                                            <img src="/storage/users/{{$a->user->photo}}" alt="Image"
                                                 style="width: 100px; height: auto">
                                        </td>
                                        <td>
                                            <ul style="list-style: none">
                                                <li>
                                                    <a href="/MyQuestion/{{$a->user->id}}/viewprofile" style="text-decoration: none">

                                                        {{$a->user->name}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <b>Answered at: </b>{{$a->created_at}}
                                                </li>
                                            </ul>

                                        </td>
                                        @guest()


                                        @else
                                            @if(Auth::user()->id == $a->user_id)
                                                <td>
                                                    <a href="/MyQuestion/{{$a->id}}/destroyanswer">
                                                        <button class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    </a>
                                                </td>
                                            @endif
                                        @endguest
                                    </tr>
                                    <tr class="table-borderless">
                                        <td colspan="3">
                                            <div style="text-align: justify">

                                                <span style="font-size: 15px" >{{$a->answer}}</span>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <hr>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                            @guest

                            @else
                                @if($data->status != 'close')
                                    <div>
                                        <form method="POST" action="/MyQuestion/addanswer">
                                            @csrf
                                            {{--                                    @method('POST')--}}

                                            <input type="hidden" name="questionId" value="{{$data->id}}">
                                            <textarea class="col-lg-12 col-md-12" rows="5" name="answer"></textarea>
                                            <button class="btn btn-danger" type="submit">
                                                Answer
                                            </button>
                                        </form>

                                    </div>
                                @endif
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
