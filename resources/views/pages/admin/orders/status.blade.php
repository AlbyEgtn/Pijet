@extends('layouts.admin')

@section('title','Status Order')
@section('header','Status Order')

@section('content')

<x-admin.admin-transaction-table 
    :transactions="$transactions"
    type="status"
/>

@endsection