@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Portfolio" />
    <x-admin.portfolios.edit-form :portfolio="$portfolio" :categories="$categories" />
@endsection
