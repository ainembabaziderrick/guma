@extends('layouts.auth')

@section('login')
<div class="login-box">
    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{ url('login') }}">Register</a>
        </div>

        <form action="{{ route('register.post') }}" method="post" class="form-login">
            @csrf
            <input type="hidden" name="level" value="2">
            {{-- Full Names --}}
            <div class="form-group has-feedback @error('name') has-error @enderror">
                <input type="text" name="name" class="form-control" placeholder="Full Names" required value="{{ old('name') }}" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @error('name')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="form-group has-feedback @error('phone') has-error @enderror">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required value="{{ old('phone') }}">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                @error('phone')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Sex --}}
            <div class="form-group has-feedback @error('sex') has-error @enderror">
                <select name="sex" class="form-control" required>
                    <option value="">Select Sex</option>
                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('sex')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Identification Type --}}
            <div class="form-group has-feedback @error('identification_type') has-error @enderror">
                <select name="identification_type" id="id_type" class="form-control" required>
                    <option value="">Select Identification</option>
                    <option value="NIN" {{ old('identification_type') == 'NIN' ? 'selected' : '' }}>NIN</option>
                    <option value="Passport" {{ old('identification_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                </select>
                @error('identification_type')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- NIN Field --}}
            <div class="form-group has-feedback @error('nin') has-error @enderror" id="nin_field" style="display: {{ old('identification_type') == 'NIN' ? 'block' : 'none' }};">
                <input type="text" name="nin" class="form-control" placeholder="Enter NIN" value="{{ old('nin') }}">
                <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                @error('nin')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Passport Field --}}
            <div class="form-group has-feedback @error('passport') has-error @enderror" id="passport_field" style="display: {{ old('identification_type') == 'Passport' ? 'block' : 'none' }};">
                <input type="text" name="passport" class="form-control" placeholder="Enter Passport Number" value="{{ old('passport') }}">
                <span class="glyphicon glyphicon-book form-control-feedback"></span>
                @error('passport')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-group has-feedback @error('status') has-error @enderror">
                <select name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="Experienced" {{ old('status') == 'Experienced' ? 'selected' : '' }}>Experienced</option>
                    <option value="Non Experienced" {{ old('status') == 'Non Experienced' ? 'selected' : '' }}>Non Experienced</option>
                </select>
                @error('status')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group has-feedback">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <p class="small mb-0">Have an Account? <a href="{{ url('login') }}">Login</a></p>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('id_type').addEventListener('change', function() {
    let ninField = document.getElementById('nin_field');
    let passportField = document.getElementById('passport_field');

    if (this.value === 'NIN') {
        ninField.style.display = 'block';
        passportField.style.display = 'none';
        document.querySelector('input[name="passport"]').value = '';
    } else if (this.value === 'Passport') {
        passportField.style.display = 'block';
        ninField.style.display = 'none';
        document.querySelector('input[name="nin"]').value = '';
    } else {
        ninField.style.display = 'none';
        passportField.style.display = 'none';
    }
});
</script>
@endsection