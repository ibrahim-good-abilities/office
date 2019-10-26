@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">

                                <select  class="form-control @error('name') is-invalid @enderror" name="cityId"   autocomplete="name" autofocus name="requirementType">
                                        <option value="" disabled selected>{{ __('Choose City') }}</option>
                                        @foreach($cities as $city)
                                        <option  value="{{$city->id}}" name="cityId" class="circle"> {{$city->cityName}} </option>
                                        @endforeach
                                </select>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userAddress" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="userAddress" type="text" class="form-control @error('userAddress') is-invalid @enderror" name="userAddress"  required autocomplete="userAddress" autofocus>

                                @error('userAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userMobile" class="col-md-4 col-form-label text-md-right">{{ __('User Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="userMobile" type="text" class="form-control @error('userMobile') is-invalid @enderror" name="userMobile"  required autocomplete="userMobile" autofocus>

                                @error('userMobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userPhone" class="col-md-4 col-form-label text-md-right">{{ __('User Phone') }}</label>

                            <div class="col-md-6">
                                <input id="userPhone" type="text" class="form-control @error('userPhone') is-invalid @enderror" name="userPhone"  required autocomplete="userPhone" autofocus>

                                @error('userPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userJopTitle" class="col-md-4 col-form-label text-md-right">{{ __('User Jop Title') }}</label>

                            <div class="col-md-6">
                                <input id="userJopTitle" type="text" class="form-control @error('userJopTitle') is-invalid @enderror" name="userJopTitle"  required autocomplete="userJopTitle" autofocus>

                                @error('userJopTitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userIdNum" class="col-md-4 col-form-label text-md-right">{{ __('User National ID') }}</label>

                            <div class="col-md-6">
                                <input id="userIdNum" type="text" class="form-control @error('userIdNum') is-invalid @enderror" name="userIdNum"  required  autofocus>

                                @error('userIdNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="userIdFile" class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>
                            <div class="col-md-6">
                                <div class="btn col-md-6">
                                    <input type="file" name="userIdFile">
                                    @error('userIdFile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
