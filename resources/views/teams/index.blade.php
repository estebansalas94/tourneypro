<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-0">
            {{ __('TEAMS') }}
        </h2>
        <div class="mb-0 p-0">
            <a href="{{ route('teams.create') }}" class="material-symbols-outlined cursor-pointer text-blue-500 text-7xl hover:text-white">
                add_box
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-20 rounded-full">
                        @foreach($teams as $team)
                            <div class="bg-gray-800 p-8 flex flex-col items-center">
                                <a href="{{ route('teams.show',$team) }}" class="text-center" style="display: inline-block; inline-size: 100%; block-size: 100%;">
                                    <span class="text-white block mb-2 font-bold">{{ $team->name }}</span>
                                    <img id="image" src="{{ asset('/storage/images/teams').'/'.$team->shield }}" alt="Shield image" class="w-44 h-44 object-cover rounded-full" style="display: inline-block;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
