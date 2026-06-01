@extends('layouts.admin')

@section('title','Pesanan Reschedule')
@section('header','Pesanan Reschedule')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="reschedule"
/>

@endsection