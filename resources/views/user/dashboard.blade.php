@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Leave your feedback') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($canSend)
                            <div class="alert alert-danger" role="alert">
                                {{__('You can leave feedback once a day')}}
                            </div>
                        @endif

                            <form action="{{route('save.bid')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="subj" class="form-label">Subject</label>
                                    <input type="text" @if($canSend)disabled @endif class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required id="subj" aria-describedby="emailHelp">
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="mess" class="form-label">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message"   @if($canSend)disabled @endif required id="mess" aria-describedby="emailHelp">{{ old('message') }}</textarea>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="mess" class="form-label">File</label>
                                    <input type="file"  @if($canSend)disabled @endif class="form-control @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit"  @if($canSend)disabled @endif class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
