@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <form action="{{route('search')}}" method="get">
                        <div class="form-group">
                            <table>
                                <tr>
                                    <td>
                                        <input type="search" name="search" class="form-control"
                                               placeholder="Name or Topic">
                                    </td>
                                    <td>
                                        <span class="form-group-btn"></span>
                                        <button type="submit" class="btn btn-primary">search</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <label>
                            @if($data->count() == 0)
                                <b style="color: darkred">Data Doesn't Exists</b>
                            @endif
                        </label>
                    </form>

                        @foreach($data as $d)
                            <table class="table table-responsive table-bordered">
                                <tr class="table-borderless">
                                    <td>
                                        <b>{{{$d->topic}}}</b>
                                    </td>
                                </tr>
                                <tr class="table-borderless">
                                    <td colspan="3">
                                        <span style="font-size: 25px">{{$d->question}}</span>
                                    </td>
                                </tr>
                                <tr class="table-borderless">
                                    <td>
                                        <img src="storage/users/{{$d->user->photo}}" alt="Image"
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
                                    <td>
                                        <a href="/MyQuestion/{{$d->id}}/answer">
                                            <button class="btn btn-danger">
                                                Answer
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
