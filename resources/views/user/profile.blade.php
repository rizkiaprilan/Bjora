@extends('layouts/app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr class="table-borderless">
                                <td rowspan="3">
                                    <img src="/storage/users/{{$data->photo}}" alt="Image"
                                         style="width: 100px; height: auto">
                                </td>
                                <td>
                                    <label style="font-weight: bold; font-size: 20px">{{$data->name}}</label>
                                </td>

                                @guest()

                                @else
                                    @if(Auth::user()->id == $data->id)
                                        <td>
                                            <a href="/MyQuestion/{{Auth::user()->id}}/editprofile">
                                                <button class="btn btn-danger">
                                                    Update Profile
                                                </button>
                                            </a>
                                        </td>
                                    @endif
                                @endguest

                            </tr>
                            <tr class="table-borderless">
                                <td>
                                    <label>{{$data->email}}</label>
                                </td>
                            </tr>
                            <tr class="table-borderless">
                                <td>
                                    <label>{{$data->address}}</label>
                                </td>
                            </tr>
                        </table>
                        @guest()

                        @else
                            @if(Auth::user()->id != $data->id)
                                <div class="card-body">
                                    <div>
                                        <form method="POST" action="/MyQuestion/message">
                                            @csrf
                                            <input type="hidden" name="receiver" value="{{$data->id}}">
                                            <textarea class="col-lg-12 col-md-12" rows="5" name="message"></textarea>
                                            <button class="btn btn-danger" type="submit">
                                                Send Message
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
