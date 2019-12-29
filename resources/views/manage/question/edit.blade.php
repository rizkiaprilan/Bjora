@extends('layouts.app')

@section('title')
    Edit Question
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Question') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('Question.update',$data->id)}}" >
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
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
                                <div class="col-md-8 offset-md-2">
                                    <select class="form-control "
                                            name="topic">
                                        <option disabled selected hidden>Select a Topic</option>
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

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <select class="form-control "
                                            name="user">
                                        <option disabled selected hidden>Select a User</option>
                                        @foreach($user as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
