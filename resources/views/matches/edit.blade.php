<x-app-layout>
    <x-slot name="header">
        <img src="{{  asset('storage/img/matches.png') }}" alt="Perfil image" width="10%" class="" style="display: block; margin: 0 auto;">
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('matches.update', $match->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                    <div class="p-4 text-gray-900 dark:text-gray-100 uppercase">
                        <p class="text-gray-600 flex items-center justify-center text-center">
                            Partido {{ $match->status }}
                        </p>
                        <p class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">calendar_month {{ $match->date_at }}</p>
                        <p class="material-symbols-outlined text-gray-600 text-xs flex py-1 items-center justify-center text-center">stadium {{ $match->teamLocal->stadium->name }}</p>
                        <div class="mb-4 p-2 text-center"><a href="{{ route('tournaments.show', $match->tournament->id) }}">{{ $match->tournament->name }}</a></div>
                        <div class="flex items-center justify-between py-12 px-16">
                            <div class="flex flex-col items-center">
                                <a href="{{ route('teams.show',$match->teamLocal) }}" class="flex flex-col items-center">
                                    <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                    <div class="text-sm text-center">
                                        <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                        <p class="text-gray-600 ">Entrenador: {{ $match->teamLocal->coach_name }}</p>
                                    </div>
                                </a>
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-center text-xl uppercase">Template</p>
                                    <table class="border-collapse border border-gray-200 mt-4 mx-auto">
                                        <thead>
                                            <tr>
                                                <th class="border border-gray-200">#</th>
                                                <th class="border border-gray-200 py-2">Nombre</th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined">sports_soccer</span></th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined text-yellow-400">style</span></th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined text-red-600">style</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($match->teamLocal->templates as $template)
                                                <tr>
                                                    <td class="border border-gray-200 px-2">{{ $template->dorsal }}</td>
                                                    <td class="border border-gray-200 px-2 py-2">{{ $template->name }} {{ $template->last_name }}</td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="goals_local[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="yellow_cards_local[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="red_cards_local[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mb-16 ">
                                <input name="goal_local" type="text" class="rounded-lg text-xl w-12 h-12 bg-gray-900 text-white text-center mb-16" onkeypress='return validaNumericos(event)'>
                            </div>
                            <div class="flex flex-col items-center text-center mx-14 mb-14 text-gray-600 font-bold">
                                <div class="text-4xl mb-14 text-white">VS</div>
                            </div>
                            <div class="mb-16">
                                <input name="goal_visitor" type="text" class="rounded-lg w-12 h-12 text-xl bg-gray-900 text-white text-center mb-16"  onkeypress='return validaNumericos(event)'>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="{{ route('teams.show',$match->teamVisitor) }}">
                                    <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                    <div class="text-sm text-center">
                                        <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                        <p class="text-gray-600">Entrenador: {{ $match->teamVisitor->coach_name }}</p>
                                    </div>
                                </a> 
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-center text-xl uppercase">Template</p>
                                    <table class="border-collapse border border-gray-200 mt-4 mx-auto">
                                        <thead>
                                            <tr>
                                                <th class="border border-gray-200 px-2">#</th>
                                                <th class="border border-gray-200 px-2 py-2">Nombre</th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined">sports_soccer</span></th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined text-yellow-400">style</span></th>
                                                <th class="border border-gray-200"><span class="material-symbols-outlined text-red-600">style</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($match->teamVisitor->templates as $template)
                                                <tr>
                                                    <td class="border border-gray-200 px-2">{{ $template->dorsal }}</td>
                                                    <td class="border border-gray-200 px-4 py-2">{{ $template->name }} {{ $template->last_name }}</td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="goals_visitor[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="yellow_cards_visitor[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                    <td class="border border-gray-200 px-2 py-2">
                                                        <input type="text" name="red_cards_visitor[{{ $template->id }}]" class="w-10 border text-black border-gray-300 rounded px-2 py-1" onkeypress='return validaNumericos(event)' placeholder="0" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center mx-14 mb-14 text-gray-600 font-bold">
                        <button type="submit" class="button">Save</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
        return true;
        }
        return false;        
    }
</script>
