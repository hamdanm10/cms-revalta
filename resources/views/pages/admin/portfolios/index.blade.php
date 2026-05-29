@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Portfolios" />
    <x-admin.portfolios.table
        :portfolios="$portfolios"
        :categories="$categories"
        :search="$search"
        :status="$status"
        :category-id="$categoryId" />
@endsection
