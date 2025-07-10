@extends('base')

@section('title')
TechBazar - Electric Shop Management System
@endsection

@section('content')
<div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>



<!-- Main Content -->

<main class="min-h-screen flex items-center justify-center px-4 pt-24 pb-10 bg-gradient-to-br from-emerald-50 via-white to-cyan-100">
    <div class="shadow-2xl rounded-3xl overflow-hidden max-w-6xl w-full mx-4 flex flex-col md:flex-row border-0" style="background: rgba(255,255,255,0.95);">
        <!-- Left Side: Welcome Section with Modern Gradient and Glass Effect -->
        <div class="md:w-1/2 p-12 flex flex-col justify-center items-center bg-gradient-to-br from-cyan-500 via-emerald-400 to-blue-400 text-white relative">
            <div class="absolute inset-0 bg-white/10 backdrop-blur-lg rounded-3xl z-0"></div>
            <div class="max-w-md mx-auto relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-white/30 p-3 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white drop-shadow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-extrabold tracking-tight drop-shadow">Tech<span class="text-yellow-200">Bazar</span></h1>
                </div>
                <h2 class="text-3xl font-bold mb-5 text-white drop-shadow">Powering Your Electrical Business</h2>
                <p class="mb-10 text-lg text-white/90 font-medium drop-shadow">
                    Streamline your shop operations with our comprehensive management system designed specifically for electrical retailers.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white/20 text-emerald-100 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                        <span class="font-semibold">Real-time inventory tracking</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white/20 text-emerald-100 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                        <span class="font-semibold">Customer & supplier management</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white/20 text-emerald-100 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                        <span class="font-semibold">Sales reports & analytics</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-white/20 text-emerald-100 shadow"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                        <span class="font-semibold">Simple and secure interface</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right Side: Login Form with Card Style -->
        <div class="md:w-1/2 p-12 flex items-center bg-gradient-to-br from-white via-emerald-50 to-cyan-100">
            <div class="w-full max-w-md mx-auto bg-white/90 rounded-2xl shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold mb-2 text-emerald-700">Welcome Back</h2>
                    <p class="text-emerald-500 font-medium">Sign in to manage your shop</p>
                </div>
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-emerald-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" required
                                class="w-full pl-10 pr-4 py-3 border-2 border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition bg-white text-emerald-700 placeholder-emerald-300"
                                placeholder="you@example.com">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-semibold text-emerald-700">Password</label>
                            <a href="#" class="text-sm text-cyan-600 hover:underline">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-4 py-3 border-2 border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none transition bg-white text-emerald-700 placeholder-emerald-300"
                                placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-400 border-emerald-200 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-emerald-700">Remember me</label>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-400 to-cyan-500 text-white py-3 px-4 rounded-lg font-semibold hover:from-cyan-500 hover:to-emerald-400 transition-all shadow-lg hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-offset-2">
                        Sign In
                    </button>
                    <div class="text-center text-sm text-emerald-700">
                        Don't have an account? <a href="{{route('register')}}" class="font-medium text-cyan-600 hover:underline">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="border-t border-emerald-200 py-6 bg-gradient-to-r from-white via-emerald-50 to-cyan-100">
    <div class="container mx-auto px-6 text-center text-emerald-700 text-sm">
        &copy; 2023 TechBazar. All rights reserved.
    </div>
</footer>

@endsection