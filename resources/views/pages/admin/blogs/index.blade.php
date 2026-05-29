@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Blogs" />
    <x-admin.blogs.table
        :blogs="$blogs"
        :categories="$categories"
        :search="$search"
        :status="$status"
        :category-id="$categoryId" />
@endsection
