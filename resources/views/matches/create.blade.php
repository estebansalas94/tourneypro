<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('tournaments.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
        <button type="button" onclick="confirmarDelete({{ $tournament->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
            <img src="{{ Storage::url('images/tournaments/' . $tournament->image) }}" alt="Tournament Image" class="h-full rounded-lg  ">
        </div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $tournament->name }}   <a href="{{ route('tournaments.edit', $tournament) }}" class="material-symbols-outlined p-2 text-blue-400 transform hover:scale-110">border_color</a></h2>
        <div class="mb-4 p-0">
            <a href="#" class="material-symbols-outlined cursor-pointer bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-2 mr-5 mt-44">sports_soccer</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Matches Program</h1>
                    <form action="{{ route('matches.store') }}" method="POST" class="mt-4">
                        @csrf

                        <div class="flex flex-wrap">
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="team_local_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Equipo Local</label>
                                <select name="team_local_id" id="team_local_id" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="" data-stadium_id="" data-stadium_name="">--select team--</option>
                                    @foreach($teams as $team)
                                        {{-- {{ var_dump($team) }} --}}
                                        <option value="{{ $team->id }}" data-stadium_id="{{ $team->stadium->id }}" data-stadium_name="{{ $team->stadium->name }}">{{ $team->name . " " . $team->coach_name}} </option>
                                        
                                    @endforeach
                                </select>                                                              
                            </div>
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="team_visitor_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Equipo Visitante</label>
                                <select name="team_visitor_id" id="team_visitor_id" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="" data-stadium_id="" data-stadium_name="">--select team--</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name . " " . $team->coach_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full px-3">
                                <label for="stadium" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Stadium</label>
                                <input type="hidden" name="stadium_id" id="stadium_id">
                                <input type="text" id="stadium_name" readonly class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                            </div>                            
                            <div  class="w-full px-3">
                                <label for="date_at" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Fecha</label>
                                <input type="datetime-local" name="date_at" id="date_at" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" placeholder="Fecha" required>
                            </div>
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Main Referee</label>
                                <select name="description" id="description" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option>--select referee--</option>
                                    @foreach($referee->where('referee_type','main referee') as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->name . " " . $ref->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Assistant Referee</label>
                                <select name="description" id="assistantReferee" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option>--select referee--</option>
                                    @foreach($referee->where('referee_type','assistant referee') as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->name . " " . $ref->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Assistant Referee</label>
                                <select name="description" id="assistantReferee2" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option>--select referee--</option>
                                    @foreach($referee->where('referee_type','assistant referee') as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->name . " " . $ref->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>                           
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Fourth Referee</label>
                                <select name="description" id="description" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option>--select referee--</option>
                                    @foreach($referee->where('referee_type','fourth referee') as $ref)
                                        <option value="{{ $ref->id }}">{{ $ref->name . " " . $ref->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input value="{{ old('id',$tournament->id) }}" type="hidden" name="tournament_id">
                            <div class="flex items-center justify-between">
                                <button type="submit" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--script para mostrar el id y el name del estadio del equipo que esta en el select local-team-->
<script>
    $(document).ready(function() {
        $('#team_local_id').change(function() {
            var selectedTeam = $(this).find('option:selected');
            var stadiumId = selectedTeam.data('stadium_id');
            var stadiumName = selectedTeam.data('stadium_name');
    
            $('#stadium_id').val(stadiumId);
            $('#stadium_name').val(stadiumName);
        });
 });
 </script>

 <!--script para que al seleccionar un team local no vuelva a mostrarse en el siguiente select team-->
<script>
    let selectedTeamIds = [];
    $(document).ready(function() {
        $('#team_local_id').change(function() {
            let selectedTeamId = $(this).val();
            selectedTeamIds.push(selectedTeamId);
            $('#team_visitor_id option').show();
            $('#team_visitor_id option[value="' + selectedTeamId + '"]').hide();
        });

        // $('#team_visitor_id').change(function() {
        //     let selectedTeamId = $(this).val();
        //     selectedTeamIds.push(selectedTeamId);
        //     $('#team_local_id option').show();
        //     $('#team_local_id option[value="' + selectedTeamId + '"]').hide();
        // });
    });
</script>

<!--script para que al seleccionar un arbitro asistente no vuelva a mostrarse en el siguiente select-->
<script>
   let selectedRefereeIds = [];
    $(document).ready(function() {
        $('#assistantReferee').change(function() {
            let selectedRefereeId = $(this).val();
            selectedRefereeIds.push(selectedRefereeId);
            $('#assistantReferee2 option').show();
            $('#assistantReferee2 option[value="' + selectedRefereeId + '"]').hide();
        });

        $('#assistantReferee2').change(function() {
            let selectedRefereeId = $(this).val();
            selectedRefereeIds.push(selectedRefereeId);
            $('#assistantReferee option').show();
            $('#assistantReferee option[value="' + selectedRefereeId + '"]').hide();
        });
    });
</script>



