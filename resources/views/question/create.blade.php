@extends('layouts/app')

@section('title')
    Add Question
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Question') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/MyQuestion/add">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-2">
                                    <textarea name="question"
                                              class="form-control @error('question') is-invalid @enderror" required
                                              placeholder="Question"></textarea>
                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-2">
                                    <select class="form-control "
                                            name="topic">
                                        <option disabled selected hidden>Select a topic</option>
                                        @foreach($data as $d)
                                            <option value="{{$d->topic}}">{{$d->topic}}</option>
                                        @endforeach
                                    </select>

                                    @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-4 col-lg-7 offset-lg-2 offset-md-2 ">
                                    <button type="submit" class="btn btn-primary btn-block" >
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
