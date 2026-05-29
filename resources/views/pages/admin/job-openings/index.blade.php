@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Job Openings" />
    <x-admin.job-openings-table :job-openings="$jobOpenings" :search="$search" :work-type="$workType" :status="$status" />
@endsection
