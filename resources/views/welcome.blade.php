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
                        <form action="#" method="get">
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="search" name="search" class="form-control"
                                                   placeholder="Name or Category">
                                        </td>
                                        <td>
                                            <span class="form-group-btn"></span>
                                            <button type="submit" class="btn btn-primary">search</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
{{--                            <label>--}}
{{--                                @if($data->count() == 0)--}}
{{--                                    <b style="color: darkred">Data Doesn't Exists</b>--}}
{{--                                @endif--}}
{{--                            </label>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
