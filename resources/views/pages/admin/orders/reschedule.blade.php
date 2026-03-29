@extends('layouts.admin')

@section('title','Order Reschedule')
@section('header','Order Reschedule')

@section('content')

<x-admin-transaction-table 
    :transactions="$transactions"
    type="reschedule"
/>

@endsection