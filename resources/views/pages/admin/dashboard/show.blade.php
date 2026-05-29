@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Dashboard" />
    <x-admin.dashboard.overview
        :stats="$stats"
        :recent-blogs="$recentBlogs"
        :recent-job-openings="$recentJobOpenings" />
@endsection
