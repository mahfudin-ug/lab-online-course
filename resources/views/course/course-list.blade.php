@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    if ($user->role == App\User::ROLE_INSTRUCTOR) $userId = $user->instructor->id;
    elseif ($user->role == App\User::ROLE_STUDENT) $userId = $user->student->id;
    else $userId = $user->id;
@endphp

<course-list :user-id="'{{ $userId }}'" :user-role="'{{ $user->role }}'"></course-list>
@endsection
