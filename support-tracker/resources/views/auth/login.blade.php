@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-8 py-8 sm:px-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">SupportTracker</h2>
                <p class="mt-2 text-sm text-slate-500">Sign in to manage team activities</p>
            </div>

            {{-- Session status (e.g. after password reset or registration) --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <a href="{{ route('password.request') }}"
                           class="text-xs text-indigo-600 hover:text-indigo-500 hover:underline transition duration-150">
                            Forgot your password?
                        </a>
                    </div>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button id="login-btn" type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                        Sign in
                    </button>
                </div>
            </form>

            {{-- Sign up link --}}
            <p class="mt-6 text-center text-sm text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                   class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline transition duration-150">
                    Create one now
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
