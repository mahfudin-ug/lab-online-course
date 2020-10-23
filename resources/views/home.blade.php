@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex w-100 justify-content-between">
                        <a class="btn btn-primary" href="{{ route('qna::list') }}">Question Management</a>
                        {{-- <a class="btn btn-primary" href="{{ route('qna::list') }}">Course Management</a> --}}
                        <a class="btn btn-primary" href="{{ route('course::list') }}">My Course</a>
                        <a class="btn btn-primary" href="{{ route('log::list') }}">Log Activity</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
