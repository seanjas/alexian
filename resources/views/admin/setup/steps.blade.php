@extends('admin.themes.layouts.main')
@section('content')
@include('admin.setup.partials.steps_scripts')
@include('admin.setup.partials.steps_style')

{{-- Content Header) --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Setup Account</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a
                            href="{{ action('App\Http\Controllers\AdminController@home') }}">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white">
                        <h3 class="card-title mb-0">Multistep Form</h3>
                    </div>
                    <div class="card-body">
                        <!-- Unified Form -->
                        <form method="POST" action="{{ action('App\Http\Controllers\EnrollController@enroll') }}"
                            id="enroll-form">
                            {{ csrf_field() }}

                            <!-- Step 1 -->
                            <div id="step-1" class="form-step">
                                <h4>Step 1: Personal Information</h4>
                                <div class="form-group">
                                    <label for="full_name">Full Name: </label>
                                    <input class="form-control" type="text" name="full_name" id="full_name"
                                        placeholder="Full Name"
                                        value="{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}"
                                        readonly />
                                </div>
                                <div class="form-group">
                                    <label for="usr_sex">Sex: </label>
                                    <select name="usr_sex" id="usr_sex" class="form-control">
                                        <option></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="usr_address">Address: </label>
                                    <input class="form-control" type="text" name="usr_address" id="usr_address"
                                        placeholder="Address" required />
                                </div>
                                <div class="form-group">
                                    <label for="usr_birth_date">Birth Date: </label>
                                    <input class="form-control" type="date" name="usr_birth_date" id="usr_birth_date"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <label for="usr_mobile">Contact Number: </label>
                                    <input class="form-control" type="text" name="usr_mobile" id="usr_mobile"
                                        placeholder="Contact Number" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="username">Email: </label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        placeholder="Email" value="{{ $user->username }}" readonly />
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div id="step-2" class="form-step" style="display:none;">
                                <h4>Step 2: Educational Background</h4>
                                <!-- Add Educational Background form fields here -->
                            </div>

                            <!-- Step 3 -->
                            <div id="step-3" class="form-step" style="display:none;">
                                <h4>Step 3: Branch Review</h4>
                                <!-- Add Branch Review form fields here -->
                            </div>

                            <!-- Step 4 -->
                            <div id="step-4" class="form-step" style="display:none;">
                                <h4>Step 4: Payment</h4>
                                <!-- Add Payment form fields here -->
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn btn-secondary" id="prev-step"
                                    style="display:none;">Previous</button>
                                <button type="button" class="btn btn-primary" id="next-step">Next</button>
                                <button type="submit" class="btn btn-success" id="submit-form"
                                    style="display:none;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
