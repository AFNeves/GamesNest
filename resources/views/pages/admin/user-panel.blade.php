@extends('layouts.app')

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('content')
    @if ($users->isEmpty())
        <h1 class="text-2xl text-center">No users found</h1>
    @else
        <div class="flex flex-col flex-grow justify-start items-center w-full space-y-4 px-[30px]">
            <div class="overflow-hidden rounded-lg w-full">
                <table class="min-w-full divide-y divide-dark">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col">Information</th>
                            <th scope="col" colspan="5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark">
                        @foreach($users as $user)
                            @if (!$user->is_admin && $user->id != 1)
                                <tr id="row-{{$user->id}}" class="users-row">
                                    {{-- Information --}}
                                    <td class="flex items-center space-x-3 px-4 pt-1.5 pb-2">
                                        <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="rounded-full cursor-pointer">
                                            <img src="{{ asset("/images/users/" . $user->id . "/" . $user->profile_picture) }}" alt="" class="w-16 h-16 rounded-full" />
                                        </a>

                                        <div class="flex flex-col space-y-1">
                                            <span>{{ $user->first_name }} {{ $user->last_name }}</span>

                                            <span>{{ $user->username }}</span>

                                            <span>{{ $user->email }}</span>
                                        </div>
                                    </td>
                                    {{-- Actions --}}
                                    <td>
                                        <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="view-profile-button" >View Profile</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="edit-profile-button" >Edit Profile</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('order.history', ['id' => $user->id]) }}" class="order-history-button" >Order History</a>
                                    </td>
                                    <td>
                                        <button class="block-user-button" data-user-id="{{ $user->id }}">{{ $user->is_blocked ? 'Unblock' : 'Block' }}</button>
                                    </td>
                                    <td>
                                        <button class="delete-user-button" data-user-id="{{ $user->id }}">Delete Account</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            {{ $users->links() }}
        </div>
    @endif
@endsection
