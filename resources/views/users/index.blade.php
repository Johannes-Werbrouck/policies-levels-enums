@php use App\Enums\UserLevel; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full table-auto">
                    <thead class="font-bold bg-gray-50 border-b-2">
                    <tr>
                        <td class="p-4">{{__('ID')}}</td>
                        <td class="p-4">{{__('Name')}}</td>
                        <td class="p-4">{{__('Email')}}</td>
                        <td class="p-4">{{__('Level')}}</td>
                        <td class="p-4">{{__('Actions')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="border">
                            <td class="p-4">{{$user->id}}</td>
                            <td class="p-4">{{$user->name}}</td>
                            <td class="p-4">{{$user->email}}</td>
                            <td class="p-4">
                            <span @class([
                                   'px-2 py-1 font-semibold text-sm rounded-lg',
                                   'text-indigo-700 bg-indigo-100' => UserLevel::Member === $user->level,
                                   'text-sky-700 bg-sky-100' => UserLevel::Contributor === $user->level,
                                   'text-teal-700 bg-teal-100' => UserLevel::Administrator === $user->level,
                                   ])>
                             {{__($user->level->name)}}
                           </span>
                            </td>
                            <td class="p-4">Actions here</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>