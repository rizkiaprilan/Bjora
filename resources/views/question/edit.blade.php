@extends('layouts/app')

@section('title')
    Update Question
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Question') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('question.update')}}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-2">
                                    <textarea name="question"
                                              class="form-control @error('question') is-invalid @enderror" required
                                              placeholder="Question">{{$data->question}}</textarea>
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
                                        <option disabled selected hidden>{{$data->topic}}</option>
                                        @foreach($topic as $t)
                                            <option value="{{$t->topic}}">{{$t->topic}}</option>
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
