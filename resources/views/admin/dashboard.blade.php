@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Manager Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">File</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bids as $bid)
                                <tr class="">
                                    <td>{{$bid->id}}</td>
                                    <td>{{$bid->subject}}</td>
                                    <td>{{$bid->message}}</td>
                                    <td>{{$bid->user->name}}</td>
                                    <td>{{$bid->user->email}}</td>
                                    <td>
                                        @if($bid->file)
                                            <a href="{{$bid->file}}" target="_blank">File</a>
                                        @else
                                            no file attached
                                        @endif
                                    </td>
                                    <td>
                                        {{$bid->created_at}}
                                    </td>
                                    <td>
                                        @if($bid->isApproved())
                                            <span class="badge bg-primary">Approved</span>
                                        @else
                                            <a href="{{route('bid.approve',$bid)}}">Approve</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
