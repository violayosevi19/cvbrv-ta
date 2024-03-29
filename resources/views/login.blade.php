@extends('home.layout.main')
@section('container')

<section class="vh-100">
  <div class="container-fluid h-custom">
    @if(session()->has('errorLogin'))
        <div class="alert alert-danger" role="alert">
          {{ session('errorLogin') }}
        </div>
      @endif
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-5 col-xl-5">
        <img src="{{ asset('assets/img/CV BERKAT REZEKI YOSEV.png') }}"
          class="img-fluid" alt="CV.BERKAT REZEKI YOSEV">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post" action="/login">
          @csrf
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-3 me-3">Sign in with</p>
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" class="form-control @error('email') @enderror form-control-lg" placeholder="Enter a valid email address" name="email" />
            <label class="form-label" for="form3Example3">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password" />
            <label class="form-label" for="form3Example4">Password</label>
          </div>
        <!-- 
          <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
            <a href="#!" class="text-body">Forgot password?</a>
          </div> -->

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                class="link-danger">Register</a></p> -->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection