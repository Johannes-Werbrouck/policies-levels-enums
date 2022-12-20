@php use App\Enums\UserLevel; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change User Level') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Update the user level of $user->name.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('userlevels.update', $user) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="level" :value="__('User Level')"/>

                            <select name="level" id="level"
                                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach(UserLevel::cases() as $levelOption)
                                    <option value="{{$levelOption}}" @if ($levelOption == $user->level) selected="selected" @endif>
                                        {{$levelOption->name}}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('level')" class="mt-2"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
