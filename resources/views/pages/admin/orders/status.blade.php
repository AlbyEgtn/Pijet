@extends('layouts.admin')

@section('title','Status Pesanan')
@section('header','Status Pesanan')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="status"
/>

@endsection