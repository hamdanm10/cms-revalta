@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Create Portfolio" />
    <x-admin.portfolios.create-form :categories="$categories" />
@endsection
