<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('tournaments.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
        <button type="button" onclick="confirmarDelete({{ $tournament->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
            <img src="{{ Storage::url('images/tournaments/' . $tournament->image) }}" alt="Tournament Image" class="h-full rounded-lg  ">
        </div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $tournament->name }}   <a href="{{ route('tournaments.edit', $tournament) }}" class="material-symbols-outlined p-2 text-blue-400 transform hover:scale-110">border_color</a></h2>
        <div class="mb-4 p-0">
            <a href="{{ route('tournaments.select-teams', $tournament->id) }}" class="material-symbols-outlined cursor-pointer bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-2 mr-5 mt-44">add</a>
            <a href="{{ route('tournaments.matches', $tournament->id) }}" class="material-symbols-outlined cursor-pointer bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-12 mr-14 mt-44">sports_esports</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-20">
                        @foreach($teams as $team)
                            <div class="bg-gray-800 p-8 flex flex-col items-center relative group">
                                <a href="{{ route('teams.show', $team) }}" class="text-center w-full h-full block">
                                    <span class="text-white block uppercase mb-2 font-bold">{{ $team->name }}</span>
                                    <div class="relative w-50 h-50">
                                        <img src="{{ asset('/storage/images/teams').'/'.$team->shield }}" alt="Image 1" class="w-44 h-44 object-cover rounded-full" style="display: inline-block;">                                        
                                    </div>
                                </a>
                                <form action="{{ route('tournaments.removeTeam', [$tournament->id, $team->id]) }}" method="POST" class="absolute bottom-0 right-0 m-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="material-symbols-outlined cursor-pointerbg-red-500 text-white px-4 py-2 rounded-full">delete</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

