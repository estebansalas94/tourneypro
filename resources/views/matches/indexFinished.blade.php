<x-app-layout>
    <x-slot name="header">
        <img src="{{  asset('storage/img/marcador.png') }}" alt="Perfil image" width="10%" class="" style="display: block; margin: 0 auto;">
        <a href="{{ route('matches.index') }}" class="button inline-flex items-center bg-blue-500 text-white px-4 py-2 rounded">
            Scheduled matches <span class="material-symbols-outlined ml-1">check_small</span>
        </a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-20 rounded-full">
                        
                        @foreach ($matches as $match)
                        <a href="{{ route('matches.finished',$match) }}">
                          <div class="max-w-sm w-full lg:max-w-full lg:flex mx-4">
                              <div class="  bg-gray-900 rounded-lg p-4 flex flex-col justify-between leading-normal">
                                <div class="mb-8 ">
                                  <p class="text-sm text-gray-600 flex items-center uppercase">
                                    <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 9h16v1H4V9zm0 3h16v1H4v-1zm0 3h16v1H4v-1zM2 5h2V2H2v3zm14 0h2V2h-2v3zm-4 0h2V2h-2v3zM4 6h2V5H4v1zm14 0h2V5h-2v1zm-4 0h2V5h-2v1z"/></svg>
                                    Partido {{ $match->status }}
                                  </p>
                                  <p class="text-gray-700 text-base">Fecha y Hora: {{ $match->date_at }}</p>
                                  <p class="text-gray-700 text-base">Estadio: {{ $match->teamLocal->stadium->name }}</p>
                                </div>
                                <div class="flex items-center justify-between">
                                  <div class="flex flex-col items-center">
                                    <img class="w-10 h-10 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                    <div class="text-sm text-center">
                                      <p class="text-gray-100 leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                      <p class="text-4xl">{{ $match->goal_local }}</p>
                                    </div>
                                  </div>
                                  <div class="mx-4 text-gray-600 font-bold">VS</div>
                                  <div class="flex flex-col items-center">
                                    <img class="w-10 h-10 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                    <div class="text-sm text-center">
                                      <p class="text-gray-100 leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                      <p class="text-4xl">{{ $match->goal_visitor }}</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

