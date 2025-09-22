@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Users</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            Back to Posts
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($user->role === 'admin') bg-red-100 text-red-800
                                @elseif($user->role === 'member') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @if($user->role !== 'admin')
                                <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="role" value="admin">
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition"
                                            onclick="return confirm('Make {{ $user->name }} an admin?')">
                                        Make Admin
                                    </button>
                                </form>
                                @endif

                                @if($user->role !== 'member')
                                <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="role" value="member">
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition"
                                            onclick="return confirm('Make {{ $user->name }} a member?')">
                                        Make Member
                                    </button>
                                </form>
                                @endif

                                @if($user->role !== 'user')
                                <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="role" value="user">
                                    <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition"
                                            onclick="return confirm('Make {{ $user->name }} a regular user?')">
                                        Make User
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
