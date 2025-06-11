@extends('base')

@section('title')
TechBaza - Electric Shop Management System
@endsection

@section('content')
<div class="flex items-center justify-center mt-10">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-6xl w-full mx-4 flex flex-col md:flex-row gap-12">
        <!-- Left Side: Welcome Text -->
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to <span class="text-blue-700">TechBazar</span></h1>
            <p class="text-gray-600 text-lg mb-6">
                TechBazar is your ultimate solution for managing electric shop operations efficiently. 
                From inventory to invoices, we help streamline everything so you can focus on growing your business.
            </p>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Real-time inventory tracking</li>
                <li>Customer & supplier management</li>
                <li>Sales reports & analytics</li>
                <li>Simple and secure interface</li>
            </ul>
        </div>

        <!-- Right Side: Login Form -->
        <div class="md:w-1/2  p-8 border border-gray-300 rounded">
            <h2 class="text-2xl font-semibold text-blue-800 mb-6 text-center">Login to Your TechBazar Account</h2>
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="you@example.com">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter your password">
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition duration-200">
                        Login
                    </button>
                </div>
                <p class="text-sm text-center text-gray-600">
                    Don't have an account? <a href="{{route('register')}}" class="text-blue-600 hover:underline">Sign up now</a>
                </p>
            </form>
        </div>
    </div>
</div>

@endsection
