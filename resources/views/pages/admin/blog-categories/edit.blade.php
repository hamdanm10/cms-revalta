@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Blog Category" />
    <x-admin.blog-categories.edit-form :blog-category="$blogCategory" />
@endsection
