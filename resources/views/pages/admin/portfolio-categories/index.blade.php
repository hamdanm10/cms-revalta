@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Portfolio Categories" />
    <x-admin.portfolio-categories.table :portfolio-categories="$portfolioCategories" :search="$search" />
@endsection
