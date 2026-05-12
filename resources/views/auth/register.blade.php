<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Stisla</title>

  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

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
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            
            <div class="login-brand">
              <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            {{-- Language Switcher --}}
            <div class="text-center mb-3">
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle" 
                            type="button" id="langDropdown" 
                            data-toggle="dropdown"
                            data-bs-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
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
              <div class="card-header"><h4>{{ __('register.register') }}</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('signup') }}" novalidate>
                  @csrf 

                  <div class="form-group">
                    <label for="name">{{ __('register.full_name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                          name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">{{ __('register.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                          name="email" value="{{ old('email') }}" required>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">{{ __('register.password') }}</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">{{ __('register.password_confirmation') }}</label>
                      <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                      @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      {{ __('register.register') }}
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="simple-footer">
              {{ __('register.already_have_account') }} <a href="{{ route('login') }}">{{ __('register.login_here') }}</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if ($errors->any())
  <script>
      Swal.fire({
          title: '{{ __("register.failed") }}',
          html: '{!! implode("<br>", $errors->all()) !!}',
          icon: 'error',
          toast: true,             
          position: 'top-end',    
          showConfirmButton: false, 
          timer: 5000              
      });
  </script>
  @endif
<script>
    document.getElementById('langDropdown').addEventListener('click', function() {
        const menu = this.nextElementSibling;
        menu.classList.toggle('show');
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
        }
    });
</script>
</body>
</html>