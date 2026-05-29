@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="{{ $blog->title }}" />
    <x-admin.blogs.show :blog="$blog" />
@endsection
