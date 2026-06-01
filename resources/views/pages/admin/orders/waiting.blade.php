@extends('layouts.admin')

@section('title','Pesanan Menunggu')
@section('header','Pesanan Menunggu')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="waiting"
/>

@endsection