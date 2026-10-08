<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IMS - Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    :root{
        --navy:#161a35;
        --pink:#ec1561;
        --orange:#f97316;
        --text-dark:#1e2235;
        --text-muted:#8a8fa3;
        --border:#edeef4;
    }
    body{
        min-height:100vh;
        background:linear-gradient(135deg,var(--navy) 0%,#1f244a 100%);
        display:flex;
        align-items:center;
        justify-content:center;
        font-family:'Segoe UI',Roboto,sans-serif;
    }
    .auth-card{
        background:#fff;
        border-radius:20px;
        padding:40px;
        width:100%;
        max-width:420px;
        box-shadow:0 20px 60px rgba(0,0,0,0.3);
    }
    .brand-icon{
        width:52px; height:52px; border-radius:14px;
        background:linear-gradient(135deg,var(--pink),var(--orange));
        display:flex; align-items:center; justify-content:center;
        color:#fff; font-size:24px; margin:0 auto 16px;
    }
    .auth-title{
        font-size:22px; font-weight:700;
        color:var(--text-dark); text-align:center; margin-bottom:4px;
    }
    .auth-subtitle{
        font-size:13px; color:var(--text-muted);
        text-align:center; margin-bottom:28px;
    }
    .form-label{ font-size:13px; font-weight:600; color:var(--text-dark); }
    .form-control{
        font-size:13.5px; padding:10px 14px;
        border-radius:9px; border:1.5px solid var(--border);
    }
    .form-control:focus{
        border-color:var(--pink);
        box-shadow:0 0 0 3px rgba(236,21,97,.1);
    }
    .input-group .form-control{ border-right:none; }
    .input-group .input-group-text{
        background:#fff; border-left:none;
        border-radius:0 9px 9px 0;
        border:1.5px solid var(--border);
        cursor:pointer; color:var(--text-muted);
    }
    .btn-pink{
        background:linear-gradient(135deg,var(--pink),var(--orange));
        border:none; color:#fff; padding:11px;
        border-radius:9px; font-weight:600; font-size:14px;
        width:100%; margin-top:8px;
        transition:.2s;
    }
    .btn-pink:hover{ opacity:.9; color:#fff; }
    .divider{
        text-align:center; color:var(--text-muted);
        font-size:12px; margin:20px 0;
        position:relative;
    }
    .divider::before,.divider::after{
        content:''; position:absolute;
        top:50%; width:42%; height:1px;
        background:var(--border);
    }
    .divider::before{ left:0; }
    .divider::after{ right:0; }
    .register-link{
        text-align:center; font-size:13px; color:var(--text-muted);
    }
    .register-link a{
        color:var(--pink); font-weight:600; text-decoration:none;
    }
    .alert-danger{ font-size:13px; border-radius:9px; }
</style>
</head>
<body>

<div class="auth-card">
    <div class="brand-icon">
        <i class="bi bi-cart4"></i>
    </div>
    <h5 class="auth-title">Welcome Back!</h5>
    <p class="auth-subtitle">MFC - Madhu Fancy Store</p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" style="font-size:13px;border-radius:9px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   value="{{ old('email') }}"
                   required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>
                <span class="input-group-text" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn-pink">
            <i class="bi bi-box-arrow-in-right me-2"></i> Login
        </button>

    </form>

    <div class="divider">or</div>

    <div class="register-link">
        Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
    </div>
</div>

<script>
function togglePassword() {
    const field = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>

</body>
</html>