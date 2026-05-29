@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="API Documentation" />
    <x-admin.api-docs.index :api-token="$apiToken" />
@endsection
