@extends('layouts.app')

@section('title', 'Search')

@section('admin-context')
    <div>
        <span>User Management</span>
    </div>
@endsection

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><a href="{{route('profile.show', ['id' => $user->id])}}" class="text-blue-600 hover:text-blue-800">{{ $user->username }}</a></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="text-blue-600 hover:text-blue-800">Edit Profile</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('profile.destroy', ['id' => $user->id]) }}" class="text-red-600 hover:text-red-800 ml-4">Delete Account</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
