@extends('layouts.app')

@section('title', 'Profile')

@section('content')


    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">

            <x-bread-crumb>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </x-bread-crumb>

            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile/' . Auth::user()->photo) : asset('default/default-profile-pic.jpg') }}"
                            class="w-50 rounded-circle" alt="">
                        <h3 class="mb-0 font-weight-bold">
                            {{ Auth::user()->name }}
                        </h3>
                        <small class="text-black-50">
                            {{ Auth::user()->email }}
                        </small>

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Phone
                        </div>
                        <div class="col-8">
                            {{ Auth::user()->phone }}
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-4">
                            Address
                        </div>
                        <div class="col-8">
                            {{ Auth::user()->address }}
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
