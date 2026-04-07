@extends('layouts.admin')

@section('title','Laporan  ')
@section('header','Laporan ')


@section('content')

<x-admin.report-table :data="$reports" />

@endsection