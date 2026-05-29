@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="{{ $portfolio->title }}" />
    <x-admin.portfolios.show :portfolio="$portfolio" />
@endsection
