@extends('layouts.finance')

@section('title','Daftar transaksi reschedule')
@section('header','Daftar transaksi reschedule')

@section('content')

<x-finance-transaction-table 
    :transactions="$transactions"
    type="reschedule"
/>

@endsection