<x-app-layout>
    <x-slot name="header">
        <img src="{{  asset('storage/img/matches.png') }}" alt="Perfil image" width="10%" class="" style="display: block; margin: 0 auto;">
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    <p class="text-gray-600 flex items-center justify-center text-center">
                        Partido Programado
                    </p>
                    <p class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">calendar_month {{ $match->date_at }}</p>
                    <p class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">stadium {{ $match->teamLocal->stadium->name }}</p>
                    <div class="flex items-center justify-between py-12 px-16">
                        <a href="{{ route('teams.show',$match->teamLocal) }}">
                            <div class="flex flex-col items-center">
                                <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                <div class="text-sm text-center">
                                    <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                    <p class="text-gray-600 ">Entrenador: {{ $match->teamLocal->coach_name }}</p>
                                </div>
                            </div>
                        </a>
                        {{-- <div class="">
                            <p class="text-gray-900 font-bold">Plantilla:</p>
                            <ul class="text-gray-700">
                                @foreach ($match->teamLocal->templates as $template)
                                    <li>{{ $template->name }} {{ $template->last_name }}</li>
                                @endforeach
                            </ul>
                        </div> --}}
                        <div class="flex flex-col items-center text-center mx-12 text-gray-600 font-bold">
                            <div class="mb-12">{{ $match->tournament->name }}</div> <!-- Añadido margen inferior -->
                            <div class="text-4xl text-white">VS</div>
                        </div>
                        <a href="{{ route('teams.show',$match->teamVisitor) }}">
                            <div class="flex flex-col items-center">
                                <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                <div class="text-sm text-center">
                                    <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                    <p class="text-gray-600">Entrenador: {{ $match->teamVisitor->coach_name }}</p>
                                </div>
                            </div>                            
                        </a>
                        {{-- <div class="mt-2">
                            <p class="text-gray-900 font-bold">Plantilla:</p>
                            <ul class="text-gray-700">
                                @foreach ($match->teamVisitor->templates as $template)
                                    <li>{{ $player->name }}</li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                    {{-- <div class="grid grid-cols-3 gap-20 rounded-full">
                        @foreach ($matches as $match)
                            <a href="#">
                                <div class="max-w-sm w-full lg:max-w-full lg:flex ">
                                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-lg lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                    <div class="mb-4 ">
                                        <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 9h16v1H4V9zm0 3h16v1H4v-1zm0 3h16v1H4v-1zM2 5h2V2H2v3zm14 0h2V2h-2v3zm-4 0h2V2h-2v3zM4 6h2V5H4v1zm14 0h2V5h-2v1zm-4 0h2V5h-2v1z"/></svg>
                                        Partido Programado
                                        </p>
                                        {{-- <div class="text-gray-900 font-bold text-xl mb-2 uppercase">{{ $match->teamLocal->name }} vs {{ $match->teamVisitor->name }}</div> --}}
                                        {{-- <p class="text-gray-700 text-base">Fecha y Hora: {{ $match->date_at }}</p>
                                        <p class="text-gray-700 text-base">Estadio: {{ $match->teamLocal->stadium->name }}</p>
                                        <p class="text-gray-700 text-base">Torneo: {{ $match->tournament->name }}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col items-center">
                                        <img class="w-10 h-10 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                        <div class="text-sm text-center">
                                            <p class="text-gray-900 leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                            <p class="text-gray-600 ">Entrenador: {{ $match->teamLocal->coach_name }}</p>
                                        </div>
                                        </div>
                                        <div class="mx-4 text-gray-600 font-bold">VS</div>
                                        <div class="flex flex-col items-center">
                                        <img class="w-10 h-10 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                        <div class="text-sm text-center">
                                            <p class="text-gray-900 leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                            <p class="text-gray-600">Entrenador: {{ $match->teamVisitor->coach_name }}</p>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>                             
                        @endforeach --}}
                    {{-- </div> --}}
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



