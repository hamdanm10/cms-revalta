@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Job Opening" />
    <x-admin.job-openings.edit-form :job-opening="$jobOpening" />
@endsection
