@extends("layout")

<?php /** @var \App\Model\User $user */ ?>

@section("content")
    <div class="row">
        <div class="col-2">First name:</div>
        <div class="col-10">{{ $user->first_name }}</div>
    </div>
    <div class="row">
        <div class="col-2">Last name:</div>
        <div class="col-10">{{ $user->last_name }}</div>
    </div>
    <div class="row">
        <div class="col-2">Email:</div>
        <div class="col-10">{{ $user->email }}</div>
    </div>
    <div class="row">
        <div class="col-2">Languages:</div>
        <div class="col-10">{!! $user->languages->implode("name", "<br>") !!}</div>
    </div>
    <div class="row">
        <div class="col-2">Pesel:</div>
        <div class="col-10">{{ $user->pesel }}</div>
    </div>

@endsection