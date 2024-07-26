<x-app-layout>
    <x-slot name="header">
        <button type="button" onclick="confirmarDelete({{ $match->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <img src="{{  asset('storage/img/marcador.png') }}" alt="Perfil image" width="10%" class="" style="display: block; margin: 0 auto;">
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    <p class="text-gray-600 flex items-center justify-center text-center uppercase">
                        Partido {{ $match->status }}
                    </p>
                    <p class="text-gray-600 flex py-1 items-center justify-center text-center"><span class="material-symbols-outlined text-sm mt-0 m-1 text-yellow-400">calendar_month</span> {{ $match->date_at }}hr</p>
                    <a href="#" class="text-gray-600 flex py-1 items-center justify-center text-center uppercase"><span class="material-symbols-outlined text-sm m-1 mt-0 text-blue-500">stadium</span> {{ $match->teamLocal->stadium->name }}</a>
                    <p class="text-gray-600 flex py-1 items-center justify-center text-center uppercase"><span class="material-symbols-outlined text-sm m-1 mt-0 text-green-500">sports</span>  {{ $mainReferee ? $mainReferee->name : 'No asignado' }} {{ $mainReferee->last_name }}</p>
                    <div class="mb-4 p-2 text-center"><a href="{{ route('tournaments.show', $match->tournament->id) }}" >{{ $match->tournament->name }}</a></div>
                    <div class="flex items-center justify-between py-12 px-16">
                            <div class="flex flex-col items-center">
                                <a href="{{ route('teams.show',$match->teamLocal) }}">
                                    <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamLocal->shield }}" alt="Logo del {{ $match->teamLocal->name }}">
                                    <div class="text-sm text-center">
                                        <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamLocal->name }}</p>
                                        <p class="text-gray-600 ">Coach: {{ $match->teamLocal->coach_name }}</p>
                                    </div>
                                </a>
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-center text-xl uppercase">Template</p>
                                    <ul class="text-gray-100 mt-4 uppercase">
                                        @foreach ($match->teamLocal->templates as $template)
                                            <li class="mt-1 text-left"> 
                                                {{ $template->dorsal }} - {{ $template->name }} {{ $template->last_name }}
                                                @php
                                                    $goals = $match->goals->where('player_id', $template->id)->count();
                                                @endphp
                                                @if ($goals > 0)
                                                    <span class="text-gray-400">
                                                        @for ($i = 0; $i < $goals; $i++)
                                                            <span class="material-symbols-outlined text-lg">sports_soccer</span>
                                                        @endfor
                                                    </span>                                                
                                                @endif
                                                @php
                                                    $yellowCards = $match->cards->where('player_id', $template->id)->where('color', 'yellow')->count();
                                                @endphp
                                                @if ($yellowCards > 0)
                                                    <span class="text-yellow-400">
                                                        @for ($i = 0; $i < $yellowCards; $i++)
                                                            <span class="material-symbols-outlined text-lg">style</span>
                                                        @endfor
                                                    </span>                                                
                                                @endif
                                                @php
                                                    $redCards = $match->cards->where('player_id', $template->id)->where('color', 'red')->count();
                                                @endphp
                                                @if ($redCards > 0)
                                                    <span class="text-red-600 ml-2">
                                                        @for ($i = 0; $i < $redCards; $i++)
                                                            <span class="material-symbols-outlined text-lg">style</span>
                                                        @endfor
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-16 ">
                                <p class="text-6xl w-12 h-12 text-white text-center mb-16">{{ $match->goal_local }}</p>
                            </div>
                            <div class="flex flex-col items-center text-center mx-14 mb-14 text-gray-600 font-bold">
                                <div class="text-6xl mb-14 text-white">-</div>
                            </div>
                            <div class="mb-16 ">
                                <p class="text-6xl w-12 h-12 text-white text-center mb-16">{{ $match->goal_visitor }}</p>
                            </div>
                        <a href="{{ route('teams.show',$match->teamVisitor) }}">
                            <div class="flex flex-col items-center">
                                <img class="shadow-lg shadow-blue-500/50 w-44 h-44 rounded-full mb-2" src="{{ asset('storage/images/teams').'/'.$match->teamVisitor->shield }}" alt="Logo del {{ $match->teamVisitor->name }}">
                                <div class="text-sm text-center">
                                    <p class="text-xl py-2 text-white leading-none uppercase">{{ $match->teamVisitor->name }}</p>
                                    <p class="text-gray-600">Coach: {{ $match->teamVisitor->coach_name }}</p>
                                </div>
                                <div class="mt-8">
                                    <p class="text-gray-600 font-bold text-xl uppercase text-center">Template</p>
                                    <ul class="text-gray-100 text-right mt-4 uppercase">
                                        @foreach ($match->teamVisitor->templates as $template)
                                            <li class="mt-1">
                                                @php
                                                    $goals = $match->goals->where('player_id', $template->id)->count();
                                                @endphp
                                                @if ($goals > 0)
                                                    <span class="text-gray-400 ">
                                                        @for ($i = 0; $i < $goals; $i++)
                                                            <span class="material-symbols-outlined text-lg">sports_soccer</span>
                                                        @endfor
                                                    </span>                                                
                                                @endif
                                                @php
                                                    $yellowCards = $match->cards->where('player_id', $template->id)->where('color', 'yellow')->count();
                                                @endphp
                                                @if ($yellowCards > 0)
                                                    <span class="text-yellow-400 ml-2">
                                                        @for ($i = 0; $i < $yellowCards; $i++)
                                                            <span class="material-symbols-outlined text-lg">style</span>
                                                        @endfor
                                                    </span>                                                
                                                @endif
                                                @php
                                                    $redCards = $match->cards->where('player_id', $template->id)->where('color', 'red')->count();
                                                @endphp
                                                @if ($redCards > 0)
                                                    <span class="text-red-600 ml-2">
                                                        @for ($i = 0; $i < $redCards; $i++)
                                                            <span class="material-symbols-outlined text-lg">style</span>
                                                        @endfor
                                                    </span>
                                                @endif
                                                {{ $template->name }} {{ $template->last_name }} - {{ $template->dorsal }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                            
                        </a> 
                </div>
                {{-- <table class="min-w-full divide-y divide-gray-200 mt-8">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Referee</th>
                            <th class="px-6  text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Name</th>
                            <th class="px-6  text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Nationality</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        <tr>
                            <td class="px-6 whitespace-nowrap">
                                <span class="material-symbols-outlined text-red-500">sports</span>
                            </td>
                            <td class="px-6 whitespace-nowrap text-white">
                                {{ $mainReferee ? $mainReferee->name : 'No asignado' }} {{ $mainReferee->last_name }}
                            </td>
                            <td class="px-6 whitespace-nowrap text-gray-400">
                                {{ $mainReferee->nationality }}
                            </td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function confirmarDelete(id){
        alertify.confirm("This is a confirm dialog.", function (e){
            if(e){
                let form = document.createElement('form')
                form.method = 'POST'
                form.action = `/matches/${id}`
                form.insertAdjacentHTML('beforeend', `
                    @csrf
                @method('DELETE')
                `)
                document.body.appendChild(form)

                alertify.success("Tournament Successfully Eliminated.").delay(100000);

                form.submit()
            } else {
                form.remove();
            }
        })

    }
</script>



