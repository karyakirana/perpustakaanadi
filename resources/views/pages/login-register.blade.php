@extends('layouts.authentication-layouts')

@section('content')
    <div class="login-form">
        <!--begin::Form-->
        <form class="form" novalidate="novalidate" action="{{route('register')}}" method="POST">
            @csrf
            <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
            </div>
            <!--end::Title-->
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="name"
                       value="{{old('name')}}"
                       autocomplete="off" />
                @error('name')
                <span class="is-invalid">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Username" name="username"
                           value="{{old('username')}}"
                           autocomplete="off" />
                    @error('username')
                    <span class="is-invalid">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email"
                       value="{{old('email')}}"
                       autocomplete="off" />
                @error('email')
                <span class="is-invalid">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
                @error('password')
                <span class="is-invalid">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" />
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <label class="checkbox mb-0">
                    <div class="ml-2">
                        <a href="{{ route('login') }}">Already registered?</a>.</div>
                </label>
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                <button type="submit" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
    </div>
@endsection
