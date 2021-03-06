@extends('layouts.app')

@section('title')
    Create Topic
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Topic') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('Topic.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-6 offset-lg-3">
                                    <textarea class="form-control @error('topic') is-invalid @enderror" name="topic" placeholder="Topic"></textarea>

                                    @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
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
