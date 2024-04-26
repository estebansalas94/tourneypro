<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('tournaments.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
        <button type="button" onclick="confirmarDelete({{ $tournament->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
            <img src="{{ Storage::url('images/tournaments/' . $tournament->image) }}" alt="Tournament Image" class="h-full rounded-lg  ">
        </div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $tournament->name }}   <a href="{{ route('tournaments.edit', $tournament) }}" class="material-symbols-outlined p-2 text-blue-400 transform hover:scale-110">border_color</a></h2>
        <div class="mb-4 p-0">
            <a href="{{ route('tournaments.select-teams', $tournament->id) }}" class="bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-2 mr-5 mt-44">New Team</a>
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
                                    <img id="image" src="{{ asset('/storage/images/teams').'/'.$team->shield }}" alt="Image 1" class="rounded-full h-50 w-50 object-cover" style="display: inline-block;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

