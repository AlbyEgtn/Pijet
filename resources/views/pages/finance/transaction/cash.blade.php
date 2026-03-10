@extends('layouts.finance')

@section('title','Daftar pembayaran cash')
@section('header','Daftar pembayaran cash')

@section('content')

<x-finance-transaction-table 
    :transactions="$transactions"
    type="cash"
/>

@endsection