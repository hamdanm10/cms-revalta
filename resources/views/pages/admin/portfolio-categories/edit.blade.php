@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Portfolio Category" />
    <x-admin.portfolio-categories.edit-form :portfolio-category="$portfolioCategory" />
@endsection
