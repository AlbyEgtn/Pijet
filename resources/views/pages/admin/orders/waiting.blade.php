@extends('layouts.admin')

@section('title','Order Menunggu')
@section('header','Order Menunggu')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="waiting"
/>

@endsection