@extends('layouts.admin')

@section('title','Status Order')
@section('header','Status Order')

@section('content')

<x-admin-transaction-table 
    :transactions="$transactions"
    type="status"
/>

@endsection