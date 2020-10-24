@extends('layouts.app')

@section('content')
<course-detail :course-id="'{{ $course }}'"></course-detail>
@endsection

@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-gKmMVFYu4ecf_is5"></script>
@endsection
