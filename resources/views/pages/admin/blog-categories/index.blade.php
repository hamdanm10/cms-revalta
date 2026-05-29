@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Blog Categories" />
    <x-admin.blog-categories.table :blog-categories="$blogCategories" :search="$search" />
@endsection
