@extends('layouts.app')
@section('birthday')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enter your birthday</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.google.user') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-container ic1">
                                        <input type="date" class="input" name="date_of_birth" placeholder=""><br>
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <input type="hidden" name="name" value="{{$user->name}}">
                                        <input type="hidden" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
