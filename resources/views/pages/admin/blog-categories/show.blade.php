@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="{{ $blogCategory->name }}" />
    <x-admin.blog-categories.show :blog-category="$blogCategory" />
@endsection
