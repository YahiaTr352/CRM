<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('panel.site_title') }} | {{ trans('global.register') }}</title>
    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
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

    <div class="max-w-[480px] w-full">
        <!-- Logo / Brand Area -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white mb-4 shadow-lg shadow-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ trans('panel.site_title') }}</h1>
            <p class="text-slate-500 mt-2 font-medium">Create your account to get started.</p>
        </div>

        <!-- Main Registration Card -->
        <div class="bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 p-10">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">{{ trans('global.user_name') }}</label>
                    <input id="name" name="name" type="text" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="John Doe" value="{{ old('name', null) }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">{{ trans('global.login_email') }}</label>
                    <input id="email" name="email" type="email" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror"
                        placeholder="you@example.com" value="{{ old('email', null) }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">{{ trans('global.login_password') }}</label>
                    <input id="password" name="password" type="password" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">{{ trans('global.login_password_confirmation') }}</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                        class="glass-input w-full h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500"
                        placeholder="••••••••" required autocomplete="new-password">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full h-12 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 transition-all duration-200 active:transform active:scale-[0.98] flex items-center justify-center space-x-2 mt-4">
                    <span>Create account</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-80" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 pt-8 border-t border-slate-200 text-center">
                <p class="text-slate-500 font-medium">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-indigo-500 transition-colors ml-1">
                        Sign in instead
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
