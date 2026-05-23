<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SupportTracker') }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Top Navbar -->
        <nav class="bg-indigo-600 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('daily.index') }}" class="flex-shrink-0 flex items-center font-bold text-xl tracking-wide">
                            SupportTracker
                        </a>
                    </div>
                    @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm bg-indigo-500 hover:bg-indigo-400 px-3 py-2 rounded-md transition duration-150">Logout</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar -->
            @auth
            <aside class="w-64 bg-white shadow-lg hidden md:block z-10 flex-shrink-0">
                <div class="h-full px-3 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('daily.index') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('daily.index') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-700' }}">
                                <span>Daily Handover</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('activities.index') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('activities.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-700' }}">
                                <span>Activities</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reports.index') }}" class="flex items-center p-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('reports.index') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-700' }}">
                                <span>Reports</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            @endauth

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-md bg-green-50 border border-green-200 flex justify-between items-start">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-md bg-red-50 border border-red-200">
                        <div class="flex justify-between">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none items-start">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
