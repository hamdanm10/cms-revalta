@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="{{ $portfolioCategory->name }}" />
    <x-admin.portfolio-categories.show :portfolio-category="$portfolioCategory" />
@endsection
