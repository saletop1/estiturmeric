{{-- resources/views/auth/admin-login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Diyani Rempah Saketi</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          gold: { DEFAULT:'#c9a84c', light:'#e8c97a', dark:'#9e7c2a', pale:'#fdf6e3' },
          ink:  { DEFAULT:'#1a1410' }
        }
      }
    }
  }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  /* ── Input fix utama: paksa teks tetap gelap di semua browser ── */
  .login-input {
    background-color: rgba(255,255,255,0.07) !important;
    border: 1px solid rgba(255,255,255,0.14);
    color: #ffffff !important;
    -webkit-text-fill-color: #ffffff !important;
    border-radius: 0.75rem;
    padding: 0.625rem 1rem 0.625rem 2.5rem;
    font-size: 0.875rem;
    width: 100%;
    outline: none;
    transition: border-color .2s, background-color .2s;
  }
  .login-input::placeholder {
    color: rgba(255,255,255,0.28) !important;
    -webkit-text-fill-color: rgba(255,255,255,0.28) !important;
  }
  .login-input:focus {
    border-color: rgba(201,168,76,0.55);
    background-color: rgba(255,255,255,0.11) !important;
  }
  .login-input.error {
    border-color: rgba(239,68,68,0.5);
  }

  /* Fix autofill Chrome / Edge — browser override background jadi kuning */
  .login-input:-webkit-autofill,
  .login-input:-webkit-autofill:hover,
  .login-input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0px 1000px #2a2118 inset !important;
    -webkit-text-fill-color: #ffffff !important;
    caret-color: #ffffff;
    border-color: rgba(201,168,76,0.4) !important;
    transition: background-color 9999s ease-in-out 0s;
  }

  /* Glow card */
  .login-card {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 1.25rem;
    padding: 2rem;
    box-shadow: 0 32px 64px -16px rgba(0,0,0,0.6),
                inset 0 1px 0 rgba(255,255,255,0.07);
  }

  /* Submit button */
  .btn-login {
    background: linear-gradient(135deg, #c9a84c, #9e7c2a);
    color: #fff;
    font-weight: 600;
    font-size: 0.875rem;
    width: 100%;
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    border: none;
    cursor: pointer;
    transition: opacity .2s, transform .2s, box-shadow .2s;
    letter-spacing: 0.02em;
  }
  .btn-login:hover {
    opacity: 0.92;
    transform: translateY(-1px);
    box-shadow: 0 12px 28px -8px rgba(201,168,76,0.45);
  }
  .btn-login:active { transform: translateY(0); }

  /* Particle bg animation */
  @keyframes floatBg {
    0%,100% { transform: scale(1.08) translateY(0); }
    50%      { transform: scale(1.08) translateY(-12px); }
  }
  .bg-img { animation: floatBg 18s ease-in-out infinite; }
</style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 overflow-hidden"
      style="background-color:#1a1410">

  {{-- Background --}}
  <div class="absolute inset-0 overflow-hidden">
    <div class="bg-img absolute inset-0"
         style="background:url('https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=1800&q=50') center/cover;
                opacity:.09"></div>
    {{-- radial vignette --}}
    <div class="absolute inset-0"
         style="background:radial-gradient(ellipse 70% 70% at 50% 50%, transparent 30%, rgba(15,10,8,.85) 100%)"></div>
    {{-- gold glow --}}
    <div class="absolute"
         style="top:-200px;left:50%;transform:translateX(-50%);width:600px;height:600px;
                background:radial-gradient(circle,rgba(201,168,76,.07) 0%,transparent 65%);
                pointer-events:none"></div>
  </div>

  <div class="relative z-10 w-full" style="max-width:360px">

    {{-- Logo --}}
    <div class="text-center mb-7">
      <div class="inline-flex items-center justify-center mb-4">
        <img src="{{ asset('images/diyani.png') }}" alt="Diyani Logo"
             class="object-contain drop-shadow-lg"
             style="width:100px;height:100px"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <i class="fas fa-seedling text-4xl" style="display:none;color:#c9a84c"></i>
      </div>
      <h1 class="font-bold text-xl" style="color:#fff">
        Diyani <span style="color:#c9a84c">Admin</span>
      </h1>
      <p class="text-xs mt-1" style="color:rgba(255,255,255,.35)">Panel Manajemen</p>
    </div>

    {{-- Card --}}
    <div class="login-card">
      <h2 class="font-semibold text-base mb-5" style="color:#fff">Masuk ke Dashboard</h2>

      {{-- Alert sukses --}}
      @if(session('success'))
      <div class="mb-4 text-sm px-4 py-3 rounded-xl"
           style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.25);color:#6ee7b7">
        <i class="fas fa-check-circle mr-1.5 text-xs"></i>{{ session('success') }}
      </div>
      @endif

      {{-- Alert error umum --}}
      @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
      <div class="mb-4 text-sm px-4 py-3 rounded-xl"
           style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#fca5a5">
        <i class="fas fa-triangle-exclamation mr-1.5 text-xs"></i>Email atau password salah.
      </div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
          <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                 style="color:rgba(255,255,255,.4)">Email</label>
          <div class="relative">
            <i class="fas fa-envelope absolute text-xs"
               style="left:.875rem;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.25)"></i>
            <input type="email" name="email" value="{{ old('email') }}"
                   required autofocus autocomplete="email"
                   class="login-input {{ $errors->has('email') ? 'error' : '' }}"
                   placeholder="admin@diyani.com">
          </div>
          @error('email')
          <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#fca5a5">
            <i class="fas fa-circle-exclamation text-[.6rem]"></i>{{ $message }}
          </p>
          @enderror
        </div>

        {{-- Password --}}
        <div>
          <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                 style="color:rgba(255,255,255,.4)">Password</label>
          <div class="relative">
            <i class="fas fa-lock absolute text-xs"
               style="left:.875rem;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.25)"></i>
            <input type="password" name="password" id="pwdInput"
                   required autocomplete="current-password"
                   class="login-input {{ $errors->has('password') ? 'error' : '' }}"
                   style="padding-right:2.75rem"
                   placeholder="••••••••">
            {{-- toggle show/hide --}}
            <button type="button" onclick="togglePwd()" tabindex="-1"
                    class="absolute"
                    style="right:.875rem;top:50%;transform:translateY(-50%);
                           background:none;border:none;cursor:pointer;
                           color:rgba(255,255,255,.25);font-size:.75rem;
                           transition:color .2s"
                    onmouseover="this.style.color='rgba(201,168,76,.7)'"
                    onmouseout="this.style.color='rgba(255,255,255,.25)'">
              <i class="fas fa-eye" id="pwdIcon"></i>
            </button>
          </div>
          @error('password')
          <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#fca5a5">
            <i class="fas fa-circle-exclamation text-[.6rem]"></i>{{ $message }}
          </p>
          @enderror
        </div>

        {{-- Remember --}}
        <div class="flex items-center gap-2">
          <input type="checkbox" name="remember" id="remember"
                 class="rounded"
                 style="accent-color:#c9a84c;width:14px;height:14px;cursor:pointer">
          <label for="remember" class="text-xs cursor-pointer"
                 style="color:rgba(255,255,255,.4)">Ingat saya</label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login mt-1">
          <i class="fas fa-right-to-bracket mr-2"></i>Masuk
        </button>
      </form>
    </div>

    {{-- Back to site --}}
    <div class="text-center mt-5">
      <a href="{{ route('home') }}"
         class="text-xs transition-colors"
         style="color:rgba(255,255,255,.25)"
         onmouseover="this.style.color='rgba(255,255,255,.55)'"
         onmouseout="this.style.color='rgba(255,255,255,.25)'">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Website
      </a>
    </div>

  </div>

  <script>
    function togglePwd() {
      const inp  = document.getElementById('pwdInput');
      const icon = document.getElementById('pwdIcon');
      const show = inp.type === 'password';
      inp.type        = show ? 'text' : 'password';
      icon.className  = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    }
  </script>
</body>
</html>