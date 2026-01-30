<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login - {{ config('app.name', 'DLC Kenya') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(248, 176, 22, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(248, 176, 22, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 520px;
            padding: 2rem;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 3rem 2.5rem;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .logo-image-wrapper {
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        .logo-image {
            max-width: 180px;
            max-height: 100px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
        }
        
        .logo-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1e3a5f 0%, #0f1f35 100%);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #f8b016;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            box-shadow: 0 10px 30px rgba(30, 58, 95, 0.3);
        }
        
        .logo-text {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 0.25rem;
            font-family: 'Poppins', sans-serif;
        }
        
        .logo-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background: #fff;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-input-group {
            position: relative;
        }
        
        .form-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
        }
        
        .form-input-with-icon {
            padding-left: 2.75rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .remember-me label {
            font-size: 0.875rem;
            color: #6b7280;
            cursor: pointer;
        }
        
        .btn-login {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-success {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
        }
        
        .alert-error {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
        }
        
        .error-message {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #ef4444;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        @media (max-width: 640px) {
            .login-container {
                padding: 1rem;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="logo-container">
                @php
                    // Get logo from settings (same logic as header component)
                    $logoFile = \App\Models\Setting::get('logo_file', '');
                    $logoUrl = \App\Models\Setting::get('logo_url', config('app.logo_url', ''));
                    $logo = $logoFile ? asset('storage/' . $logoFile) : ($logoUrl ?: null);
                @endphp
                
                @if($logo)
                    <div class="logo-image-wrapper">
                        <img src="{{ $logo }}" 
                             alt="{{ config('app.name', 'DLC') }} Logo" 
                             class="logo-image"
                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="logo-icon" style="display: none;">DLC</div>
                    </div>
                @else
                    <div class="logo-icon">DLC</div>
                @endif
                <div class="logo-text">Destiny Life Coaching</div>
                <div class="logo-subtitle">Admin Portal</div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="form-input-group">
                        <i class="fas fa-envelope form-input-icon"></i>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            autocomplete="email"
                            class="form-input form-input-with-icon @error('email') border-red-500 @enderror"
                            placeholder="admin@dlc.co.ke"
                        >
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-group">
                        <i class="fas fa-lock form-input-icon"></i>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="form-input form-input-with-icon @error('password') border-red-500 @enderror"
                            placeholder="Enter your password"
                        >
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>
            </form>

            <!-- Footer -->
            <div class="footer-text">
                <p>&copy; {{ date('Y') }} Destiny Life Coaching Kenya. All rights reserved.</p>
                <p class="mt-1">Secure Admin Access</p>
            </div>
        </div>
    </div>
</body>
</html>
