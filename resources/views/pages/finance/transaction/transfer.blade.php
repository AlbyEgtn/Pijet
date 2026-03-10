@extends('layouts.finance')

@section('title','Daftar pembayaran transfer')
@section('header','Daftar pembayaran transfer')

@section('content')

<x-finance-transaction-table 
    :transactions="$transactions"
    type="transfer"
/>

@endsection