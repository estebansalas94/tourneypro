<x-app-layout>
    <x-slot name="header">
        <img src="{{  asset('storage/img/matches.png') }}" alt="Perfil image" width="10%" class="" style="display: block; margin: 0 auto;">
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    <p class="text-gray-600 flex items-center justify-center text-center uppercase">
                        Partido {{ $match->status }}
                    </p>
                    <p class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">calendar_month {{ $match->date_at }}</p>
                    <a href="#" class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">stadium {{ $match->teamLocal->stadium->name }}</a>
                    <div class="mb-4 p-2 text-center"><a href="{{ route('tournaments.show', $match->tournament->id) }}" >{{ $match->tournament->name }}</a></div>
                    <div class="flex items-center justify-between py-12 px-16">
                        
                            <div class="flex flex-col items-center">
                                <a href="{{ route('teams.show',$match->teamLocal) }}">
                                    <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                    <div class="text-sm text-center">
                                        <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                        <p class="text-gray-600 ">Entrenador: {{ $match->teamLocal->coach_name }}</p>
                                    </div>
                                </a>
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-center text-xl uppercase">Template</p>
                                    <ul class="text-gray-100  mt-4 uppercase">
                                        @foreach ($match->teamLocal->templates as $template)
                                            <li class="mt-1">{{ $template->dorsal }} - {{ $template->name }} {{ $template->last_name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        
                        <div class="flex flex-col items-center text-center mx-14 mb-14 text-gray-600 font-bold">
                            <div class="text-4xl mb-14 text-white">VS</div>
                            <a href="{{ route('matches.edit', $match) }}" class="material-symbols-outlined mb-14">edit</a>
                        </div>
                        <a href="{{ route('teams.show',$match->teamVisitor) }}">
                            <div class="flex flex-col items-center">
                                <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                <div class="text-sm text-center">
                                    <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                    <p class="text-gray-600">Entrenador: {{ $match->teamVisitor->coach_name }}</p>
                                </div>
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-xl uppercase text-center">Template</p>
                                    <ul class="text-gray-100 text-right mt-4 uppercase">
                                        @foreach ($match->teamVisitor->templates as $template)
                                            <li class="mt-1">{{ $template->name }} {{ $template->last_name }} - {{ $template->dorsal }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                            
                        </a> 
                </div>
                
            </div>
            {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div>
                    {{ $referees->links() }}
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout><!--script de confirmar delete con alertifyjs-->



