<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-0">
            {{ __('TOURNAMENTS') }}
        </h2>
        <div class="mb-0 p-0">
            <a href="{{ route('tournaments.create') }}" class="material-symbols-outlined cursor-pointer text-blue-500 text-7xl hover:text-white">
                add_box
            </a>
            <a href="{{ route('referees.index') }}" class="material-symbols-outlined cursor-pointer bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-4 px-4 rounded focus:outline-none focus:shadow-outline absolute top-0 right-8 mr-1 mt-32">sports</a>


        </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto rounded-md">
                        <div class="grid grid-cols-3 gap-4 rounded-md ">
                            @foreach($tournaments as $tournament)
                                <div class="bg-gray-800 p-8">
                                    <a href="{{ route('tournaments.show',$tournament) }}" class="text-center" style="display: inline-block; inline-size: 100%; block-size: 100%;">
                                        <span class="text-blue-500 font-bold hover:text-white" >{{ $tournament->name }}</span>
                                        <img id="image" src="{{ asset('/storage/images/tournaments').'/'.$tournament->image }}" alt="Image tournament" class="w-full h-auto rounded-lg" style="display: inline-block; inline-size: 100%; block-size: 100%;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div>
                    {{ $tournaments->links() }}
                </div>
            </div>
                </div>
            </div>
</x-app-layout>
