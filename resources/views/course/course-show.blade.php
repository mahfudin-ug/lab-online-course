@extends('layouts.app')

@section('content')
<course-detail :course-id="'{{ $course }}'"></course-detail>
@endsection
