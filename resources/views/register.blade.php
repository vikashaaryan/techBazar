@extends('base')

@section('title')
TechBazar | Register Page
@endsection

@section('content')
<div class="flex items-center justify-center mt-10 mb-16">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-6xl w-full mx-4 flex flex-col md:flex-row gap-12">
        <!-- Left Side: Info Text -->
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Join <span class="text-blue-700">TechBazar</span> Today</h1>
            <p class="text-gray-600 text-lg mb-6">
                Manage your electric shop operations with ease using TechBazar. Register now and enjoy seamless business management.
            </p>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Easy billing & invoicing</li>
                <li>Track stock & inventory in real-time</li>
                <li>Manage suppliers & customers</li>
                <li>Access sales analytics anytime</li>
            </ul>
        </div>

        <!-- Right Side: Register Form -->
        <div class="md:w-1/2 p-8 border border-gray-300 rounded">
            <h2 class="text-2xl font-semibold text-blue-800 mb-6 text-center">Create Your TechBazar Account</h2>
            <form action="{{route('usreregister')}}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                    <input id="name" name="name" type="text" 
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Rohit kumar">
                        @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            
                        @enderror
                </div>
                <div>
                    <label for="contact" class="block text-gray-700 font-medium mb-1">Contact Number</label>
                    <input id="contact" name="contact" type="tel" 
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="+91 98765 43210">
                        @error('contact')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            
                        @enderror
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                    <input id="email" name="email" type="email" 
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="you@example.com">
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            
                        @enderror
                </div>
                <div>
                    <label for="role" class="block text-gray-700 font-medium mb-1">Register As</label>
                    <select id="role" name="role" 
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="" disabled selected>Select Role</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <input id="password" name="password" type="password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Enter your password">
                        @error('password')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror

                </div>
              
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition duration-200">
                        Register
                    </button>
                </div>
                <p class="text-sm text-center text-gray-600">
                    Already have an account? 
                    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
