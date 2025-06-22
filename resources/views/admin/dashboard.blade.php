@extends('admin.admin-parent')
@section('main')
    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Hello Developers</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Sample content cards -->
            <div class="bg-white dark:bg-dark-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Card Title</h2>
                <p class="text-gray-600 dark:text-gray-300">This is a sample card content. Hover over the sidebar to
                    see it expand.</p>
            </div>
            <div class="bg-white dark:bg-dark-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Card Title</h2>
                <p class="text-gray-600 dark:text-gray-300">This is a sample card content. Hover over the sidebar to
                    see it expand.</p>
            </div>
            <div class="bg-white dark:bg-dark-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Card Title</h2>
                <p class="text-gray-600 dark:text-gray-300">This is a sample card content. Hover over the sidebar to
                    see it expand.</p>
            </div>
        </div>
    </div>
@endsection