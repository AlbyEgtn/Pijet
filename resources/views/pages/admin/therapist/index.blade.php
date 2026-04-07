@extends('layouts.admin')

@section('title','Terapis Aktif ')
@section('header','Terapis Aktif ')


@section('content')



    <x-admin.therapist-table :therapists="$therapists" mode="list" />


@endsection