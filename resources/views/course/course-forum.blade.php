@extends('layouts.app')

@section('content')
<course-forum :course-id="'{{ $course }}'"></course-forum>
@endsection
