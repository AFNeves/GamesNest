@extends('layouts.app')

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('footer-logo')
    @include('widgets.footer.footer-logo')
@endsection

@section('footer-nav')
    @include('widgets.footer.footer-nav')
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-black cursor-pointer">
                            <thead class="bg-gray-100">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black">
                                @foreach($users as $user)
                                    <tr class="users-row">
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <a href="{{route('profile.show', ['id' => $user->id])}}"
                                               class="text-blue-600 hover:text-blue-800">{{ $user->username }}</a>
                                        </td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('profile.edit', ['id' => $user->id]) }}"
                                               class="text-blue-600 hover:text-blue-800">Edit Profile</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('profile.destroy', ['id' => $user->id]) }}"
                                               class="text-red-600 hover:text-red-800 ml-4">Delete Account</a>
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
