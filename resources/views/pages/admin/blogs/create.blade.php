@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Create Blog" />
    <x-admin.blogs.create-form :categories="$categories" />
@endsection
