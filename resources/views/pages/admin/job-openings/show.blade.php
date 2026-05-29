@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Job Opening Details" />
    <x-admin.job-openings.show :job-opening="$jobOpening" />
@endsection
