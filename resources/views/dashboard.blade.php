<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome, {{ auth()->user()->name }}!</h3>
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Your current role:</strong>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 ml-1">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </p>
                        <p class="text-xs text-blue-600 mt-2">
                            You can only access sections that match your assigned role. Contact an administrator to change your role.
                        </p>
                    </div>
                    <p class="mb-6 text-gray-600">Choose how you want to continue:</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Admin Option -->
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center hover:bg-red-100 transition">
                            <div class="mb-4">
                                <i class="fas fa-crown text-red-500 text-4xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-red-800 mb-2">Continue as Admin</h4>
                            <p class="text-red-600 text-sm mb-4">Manage posts, approve content, and oversee the platform</p>
                            <a href="{{ route('role.select', 'admin') }}"
                               class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                                Enter Admin Panel
                            </a>
                        </div>

                        <!-- Member Option -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center hover:bg-blue-100 transition">
                            <div class="mb-4">
                                <i class="fas fa-edit text-blue-500 text-4xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">Continue as Member</h4>
                            <p class="text-blue-600 text-sm mb-4">Create posts and share your thoughts with the community</p>
                            <a href="{{ route('role.select', 'member') }}"
                               class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                                Create Post
                            </a>
                        </div>

                        <!-- User Option -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center hover:bg-green-100 transition">
                            <div class="mb-4">
                                <i class="fas fa-users text-green-500 text-4xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-green-800 mb-2">Continue as User</h4>
                            <p class="text-green-600 text-sm mb-4">Browse posts, like, comment, and interact with content</p>
                            <a href="{{ route('role.select', 'user') }}"
                               class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                                View Feed
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
