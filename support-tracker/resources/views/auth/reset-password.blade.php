@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-8 py-8 sm:px-10">
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 w-14 h-14 bg-indigo-50 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Set New Password</h2>
                <p class="mt-2 text-sm text-slate-500">
                    Choose a strong password for your account.
                </p>
            </div>

            <form id="reset-password-form" method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf

                {{-- Hidden token --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email', $request->email) }}"
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">New Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               placeholder="Min. 8 characters"
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('password') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm New Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               autocomplete="new-password" required
                               placeholder="Re-enter your new password"
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button id="reset-password-btn" type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                    Reset Password
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                <a href="{{ route('login') }}"
                   class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline transition duration-150">
                    Back to Sign In
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
