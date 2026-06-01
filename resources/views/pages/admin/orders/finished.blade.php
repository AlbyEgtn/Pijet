@extends('layouts.admin')

@section('title','Pesanan Selesai')
@section('header','Pesanan Selesai')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="finished"
/>

@endsection