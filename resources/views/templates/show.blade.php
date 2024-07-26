<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('teams.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
        <button type="button" onclick="confirmarDelete({{ $template->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <a href="{{ route('templates.edit', $template) }}" class="material-symbols-outlined cursor-pointer text-blue-700 text-2xl active:text-blue-900 transform hover:scale-110 absolute top-12 right-8 mr-8 mt-5">border_color</a>
        <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg m-8 text-gray-500 flex justify-between">
            <div class="flex items-start">
                <img src="{{ Storage::url('images/templates/' . $template->image) }}" alt="Shield Image" class="h-full rounded-lg">
                <div class="ml-4 mt-2">
                    <h1 class="font-bold text-xl uppercase text-gray-800 dark:text-gray-200 leading-tight">{{ $template->name }} {{ $template->last_name }}</h1>
                    <p class="text-xs mt-4 text-gray-800 dark:text-gray-200 leading-tight">Age: {{ $ages[0] }} ({{ $template->birth_date_at }})</p>
                    <p class="text-xs text-gray-800 dark:text-gray-200 leading-tight">Nationality: {{ $template->nationality }}</p>
                    <p class="text-xs text-gray-800 dark:text-gray-200 leading-tight">Club: {{ $template->team->name }}</p>
                    <p class="text-xs text-gray-800 dark:text-gray-200 leading-tight">Dorsal: {{ $template->dorsal }}</p>
                    <p class="text-xs text-gray-800 dark:text-gray-200 leading-tight">Position: {{ $template->position }}</p>
                </div>
            </div>
            <div class="flex items-start">
                <img src="{{ Storage::url('images/teams/' . $template->team->shield) }}" alt="Shield Image" class="h-full rounded-lg">
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 uppercase">
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <h2 class="text-white text-lg mb-4">Últimos partidos</h2>
                        <table class="w-full text-gray-300">
                            <thead class="text-center">
                                <tr class="text-xs">
                                    <th class="p-2">Fecha</th>
                                    <th class="p-2">Competencia</th>
                                    <th class="p-2">Partidos</th>
                                    <th class="p-2"><span class="material-symbols-outlined text-xl text-blue-600">sports_soccer</span></th>
                                    <th class="p-2"><span class="material-symbols-outlined text-xl text-yellow-400">style</span></th>
                                    <th class="p-2"><span class="material-symbols-outlined text-xl text-red-600">style</span</th>
                                    <th class="p-2">Resultado</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($matches as $match)
                                    <tr class="bg-gray-800 hover:bg-gray-700 text-sm mt-4">
                                        <td class="p-2">{{ $match->date_at }}hr</td>
                                        <td class="p-2">{{ $match->tournament->name }}</td>
                                        <td class="p-2 flex items-center justify-center">
                                            <div class="flex items-center">
                                                <img src="{{ Storage::url('images/teams/' . $match->teamLocal->shield) }}" alt="escudo equipo" class="h-4 w-4 mr-2">{{ $match->teamLocal->name }}
                                            </div>
                                            <span class="mx-2">{{ $match->goal_local }}</span>
                                            <span class="mx-2">-</span>
                                            <span class="mx-2">{{ $match->goal_visitor }}</span>
                                            <div class="flex items-center">
                                                {{ $match->teamVisitor->name }} <img src="{{ Storage::url('images/teams/' . $match->teamVisitor->shield) }}" alt="Senegal" class="ml-2 h-4 w-4 mr-2">
                                            </div>
                                        </td>
                                        @php
                                            $playerGoals = $match->goals->where('player_id', $template->id)->count();
                                            $playerYellowCards = $match->cards->where('player_id', $template->id)->where('color', 'yellow')->count();
                                            $playerRedCards = $match->cards->where('player_id', $template->id)->where('color', 'red')->count();
                                        @endphp
                                        <td class="p-2">{{ $playerGoals }}</td>
                                        <td class="p-2">{{ $playerYellowCards }}</td>
                                        <td class="p-2">{{ $playerRedCards }}</td>
                                        <td class="p-2">
                                            @if($match->goal_local > $match->goal_visitor)
                                                @if($team->id == $match->teamLocal->id)
                                                    <a href="{{ route('matches.finished',$match) }}" class="inline-flex items-center justify-center bg-green-500 text-white p-1 rounded-md text-xs w-8 h-8">G</a>
                                                @else
                                                    <a href="{{ route('matches.finished',$match) }}" class="inline-flex items-center justify-center bg-red-500 text-white p-1 rounded-md text-xs w-8 h-8">P</a>
                                                @endif
                                            @elseif($match->goal_local < $match->goal_visitor)
                                                @if($team->id == $match->teamVisitor->id)
                                                    <a href="{{ route('matches.finished',$match) }}" class="inline-flex items-center justify-center bg-green-500 text-white p-1 rounded-md text-xs w-8 h-8">G</a>
                                                @else
                                                    <a href="{{ route('matches.finished',$match) }}" class="inline-flex items-center justify-center bg-red-500 text-white p-1 rounded-md text-xs w-8 h-8">P</a>
                                                @endif
                                            @else
                                                <a href="{{ route('matches.finished',$match) }}" class="inline-flex items-center justify-center bg-orange-500 text-white p-1 rounded-md text-xs w-8 h-8">E</a>
                                            @endif
                                        </td>                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!--<div class="py-12 pt-0">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $template->team->name }}
                </div>
            </div>
        </div>
    </div>-->
</x-app-layout>

<!--script de confirmar delete con alertifyjs-->
<script>
    function confirmarDelete(id){
        alertify.confirm("This is a confirm dialog.", function (e){
            if(e){
                let form = document.createElement('form')
                form.method = 'POST'
                form.action = `/templates/${id}`
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

