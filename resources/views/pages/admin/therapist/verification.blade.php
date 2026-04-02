@extends('layouts.admin')

@section('title','Verifikasi Terapis ')
@section('header','Verifikasi Terapis ')

@section('content')

    <x-admin.therapist-table :therapists="$therapists" mode="verify" />

@endsection