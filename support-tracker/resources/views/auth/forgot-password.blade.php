@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-8 py-8 sm:px-10">
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 w-14 h-14 bg-indigo-50 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Forgot Password?</h2>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    No worries. Enter your email and we'll send you a link to reset your password.
                </p>
            </div>

            {{-- Success status --}}
            @if (session('status'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm text-green-800">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               placeholder="you@company.com"
                               class="appearance-none block w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400' : 'border-slate-300' }} rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button id="send-reset-btn" type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                    Send Reset Link
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                Remembered it?
                <a href="{{ route('login') }}"
                   class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline transition duration-150">
                    Back to Sign In
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
