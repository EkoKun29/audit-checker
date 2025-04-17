@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h1>Selamat Datang {{ auth()->user()->name }} !</h1>
    <p>Kelola disini
    </p>
@endsection


