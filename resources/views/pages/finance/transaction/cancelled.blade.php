@extends('layouts.finance')

@section('title','Daftar transaksi dibatalkan')
@section('header','Daftar transaksi dibatalkan')

@section('content')

<x-finance-transaction-table 
    :transactions="$transactions"
    type="cancel"
/>

@endsection