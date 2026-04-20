<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('panel.site_title') }} | Login</title>
    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN for immediate modernization -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .mesh-gradient {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%);
        }
        .glass-input {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-input:focus {
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>
<body class="mesh-gradient min-h-screen flex items-center justify-center p-6">

    <div class="max-w-[440px] w-full">
        <!-- Logo / Brand Area -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white mb-4 shadow-lg shadow-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ trans('panel.site_title') }}</h1>
            <p class="text-slate-500 mt-2 font-medium">Welcome back! Please enter your details.</p>
        </div>

        <!-- Main Login Card -->
        <div class="bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 p-10">
            
            @if(session('message'))
                <div class="mb-6 p-4 rounded-xl bg-indigo-50/50 text-indigo-700 text-sm font-semibold border border-indigo-100/50 flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Email Address</label>
                    <input id="email" name="email" type="email" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror"
                        placeholder="admin@admin.com" value="{{ old('email', null) }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Password</label>
                    <input id="password" name="password" type="password" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between ml-1">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                        <label for="remember" class="ml-2 text-sm font-medium text-slate-600 cursor-pointer select-none">
                            Keep me logged in
                        </label>
                    </div>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full h-12 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 transition-all duration-200 active:transform active:scale-[0.98] flex items-center justify-center space-x-2">
                    <span>Sign in to account</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-80" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 pt-8 border-t border-slate-200 text-center">
                <p class="text-slate-500 font-medium">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:text-indigo-500 transition-colors ml-1">
                        Get started for free
                    </a>
                </p>
            </div>
        </div>

        <!-- Bottom Links -->
        <div class="mt-8 flex justify-center space-x-6 text-slate-400 text-sm font-medium">
            <a href="#" class="hover:text-slate-600 transition-colors">Privacy Policy</a>
            <a href="#" class="hover:text-slate-600 transition-colors">Terms of Service</a>
        </div>
    </div>

</body>
</html>
