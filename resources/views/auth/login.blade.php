<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="{{ ('assets/frontend/img/kdm.png')}}" rel="icon">

<link rel="stylesheet" href="{{asset ('/assets/backend/css/styles.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<title>Login</title>

<style>

body{
    min-height:100vh;
    background: linear-gradient(135deg,#89f7fe,#66a6ff);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Poppins', sans-serif;
}

/* Card Login */
.login-card{
    width:380px;
    padding:35px;
    border-radius:20px;
    backdrop-filter:blur(15px);
    background:rgba(255,255,255,0.2);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* Title */
.login-title{
    text-align:center;
    font-weight:700;
    margin-bottom:30px;
    color:#fff;
}

/* Input */
.form-control{
    border-radius:12px;
    padding:12px 15px;
    background:rgba(255,255,255,0.8);
    border:none;
}

/* Button */
.btn-login{
    background:#4CAF50;
    color:white;
    border-radius:12px;
    padding:12px;
    font-weight:600;
    transition:0.3s;
}

.btn-login:hover{
    background:#43a047;
}

/* Icon input */
.input-group-text{
    border:none;
    background:rgba(255,255,255,0.8);
    border-radius:12px 0 0 12px;
}

</style>

</head>

<body>

<div class="login-card">

<h3 class="login-title">🔐 LOGIN</h3>

<form method="POST" action="{{ route('login') }}">
@csrf

{{-- EMAIL --}}
<div class="mb-3">
<label class="form-label text-white">Email</label>

<div class="input-group">
<span class="input-group-text">
<i class="bi bi-envelope"></i>
</span>

<input id="email" type="email"
class="form-control @error('email') is-invalid @enderror"
name="email"
value="{{ old('email') }}"
required autofocus>

@error('email')
<span class="invalid-feedback d-block">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>



{{-- PASSWORD --}}
<div class="mb-4">
<label class="form-label text-white">Password</label>

<div class="input-group">
<span class="input-group-text">
<i class="bi bi-lock"></i>
</span>

<input id="password" type="password"
class="form-control @error('password') is-invalid @enderror"
name="password"
required>

@error('password')
<span class="invalid-feedback d-block">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>



<button type="submit" class="btn btn-login w-100">
Login
</button>

</form>

</div>

</body>
</html>
