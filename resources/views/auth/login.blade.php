<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; OMDB</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <style>
    #langDropdown {
        background-color: #6777ef;
        color: white;
        border-color: #6777ef;
    }
    #langDropdown:hover {
        background-color: #5a67d8;
        border-color: #5a67d8;
    }
  </style>

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            
            <div class="login-brand">
              <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            {{-- Language Switcher --}}
            <div class="text-center mb-3">
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle" 
                            type="button" id="langDropdown" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="langDropdown">
                        <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" 
                           href="{{ route('language.switch', 'en') }}">
                            English
                        </a>
                        <a class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}" 
                           href="{{ route('language.switch', 'id') }}">
                            Bahasa Indonesia
                        </a>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{ __('auth.login') }}</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" novalidate="">
                  @csrf
                  
                  <div class="form-group">
                    <label for="email">{{ __('auth.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                          name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                    
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @else
                      <div class="invalid-feedback">
                        {{ __('auth.fill_email') }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">{{ __('auth.password') }}</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                          name="password" tabindex="2" required>
                    
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @else
                      <div class="invalid-feedback">
                        {{ __('auth.fill_password') }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      {{ __('auth.login') }}
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="mt-5 text-muted text-center">
              {{ __('auth.no_account') }} <a href="{{ url('/register') }}">{{ __('auth.create_one') }}</a>
            </div>

            <div class="simple-footer">
              Copyright &copy; Stisla <span id="year"></span>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script>
    const year = document.getElementById('year');
    year.innerHTML = new Date().getFullYear();  
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if(session()->has('success'))
  <script>
      Swal.fire({
          text: "{{ session('success') }}",
          icon: 'success',
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif

  @if(session()->has('error'))
  <script>
      Swal.fire({
          text: "{{ session('error') }}",
          icon: 'error',
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif
</body>
</html>