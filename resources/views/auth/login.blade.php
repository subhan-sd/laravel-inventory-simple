<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ElectroTech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#eff6ff', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-8 pb-6 border-b border-slate-50 text-center">
                <div class="size-12 bg-brand-600 rounded-2xl flex items-center justify-center text-white mx-auto mb-4 shadow-lg shadow-brand-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Welcome Back</h1>
                <p class="text-slate-500 text-sm mt-1">Sign in to ElectroTech Portal</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="p-8 space-y-6">
                @csrf
                @if (session('success'))
                    <div class="p-3 bg-emerald-50 text-emerald-700 text-xs font-medium rounded-xl border border-emerald-100">
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                           placeholder="name@company.com">
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="size-4 border-slate-300 rounded text-brand-600 focus:ring-brand-500">
                        <span class="text-xs text-slate-500 group-hover:text-slate-700">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl shadow-lg shadow-slate-200 transition-all transform active:scale-[0.98]">
                    Sign In
                </button>
            </form>

            <div class="p-4 bg-slate-50 border-t border-slate-100 text-center">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Enterprise Edition v2.0</p>
            </div>
        </div>
        
        <div class="mt-8 text-center text-slate-400 text-xs">
            <p>&copy; {{ date('Y') }} ElectroTech Solutions. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
