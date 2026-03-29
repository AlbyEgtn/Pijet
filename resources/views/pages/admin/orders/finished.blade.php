@extends('layouts.admin')

@section('title','Order Selesai')
@section('header','Order Selesai')

@section('content')

<x-admin-transaction-table 
    :transactions="$transactions"
    type="finished"
/>

@endsection