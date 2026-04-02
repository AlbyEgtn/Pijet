@extends('layouts.admin')

@section('title','Data Customer')
@section('header','Data Customer ')


@section('content')

<x-admin.customer-table :data="$customers" />

@endsection