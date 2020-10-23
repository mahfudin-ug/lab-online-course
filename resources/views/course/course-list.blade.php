@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $userId = $user->id;

    if ($user->role == App\User::ROLE_INSTRUCTOR) $userId = $user->instructor ? $user->instructor->id : $userId;
    elseif ($user->role == App\User::ROLE_STUDENT) $userId = $user->student ? $user->student->id : $userId;
@endphp

<course-list :user-id="'{{ $userId }}'" :user-role="'{{ $user->role }}'"></course-list>
@endsection
