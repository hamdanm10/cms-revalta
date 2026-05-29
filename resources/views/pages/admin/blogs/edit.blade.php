@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Blog" />
    <x-admin.blogs.edit-form :blog="$blog" :categories="$categories" />
@endsection
