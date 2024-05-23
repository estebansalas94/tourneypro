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
                                <label for="team_local_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Home Team <span class="text-red-500">*</span></label>
                                <select name="team_local_id" id="team_local_id" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="" data-stadium_id="" data-stadium_name="">--select team--</option>
                                    @foreach($teams as $team)
                                        {{-- {{ var_dump($team) }} --}}
                                        <option value="{{ $team->id }}" {{ old('team_local_id') == $team->id ? 'selected' : '' }} data-stadium_id="{{ $team->stadium->id }}" data-stadium_name="{{ $team->stadium->name }}">{{ $team->name . " " . $team->coach_name}} </option>
                                    @endforeach
                                </select>
                                @error('team_local_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror                                                              
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="team_visitor_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Away Team <span class="text-red-500">*</span></label>
                                <select name="team_visitor_id" id="team_visitor_id" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" disabled>
                                    <option value="" data-stadium_id="" data-stadium_name="">--select team--</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ old('team_visitor_id') == $team->id ? 'selected' : '' }}>{{ $team->name . " " . $team->coach_name}}</option>
                                    @endforeach
                                </select>
                                @error('team_visitor_id')
                                    <div class="flex items-center bg-transparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full px-3">
                                <label for="stadium" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Stadium <span class="text-red-500">*</span></label>
                                @php
                                    $oldStadiumId = old('stadium_id');
                                    $oldStadiumName = $team->stadium->firstWhere('id', $oldStadiumId)->name ?? '';
                                @endphp
                                <input type="hidden" value="{{ old('stadium_id') }}" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" name="stadium_id" id="stadium_id">
                                <input type="text" value="{{ $oldStadiumName}}" id="stadium_name" readonly class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                                @error('stadium_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>                            
                            <div  class="w-full px-3">
                                <label for="date_at" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Match Date <span class="text-red-500">*</span></label>
                                <input type="datetime-local" value="{{ old('date_at') }}" name="date_at" id="date_at" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                                @error('date_at')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Main Referee <span class="text-red-500">*</span></label>
                                <select name="referee_id[]" id="description" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">--select referee--</option>
                                    @foreach($referee->where('referee_type','main referee') as $ref)
                                         <option value="{{ $ref->id }}" {{--{{ in_array($ref->id, (array) old('referee_id')) ? 'selected' : '' }}--}}>{{ $ref->name . " " . $ref->last_name }}</option> 
                                    @endforeach
                                </select>
                                @error('referee_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Assistant Referee <span class="text-red-500">*</span></label>
                                <select name="referee_id[]" id="assistantReferee" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">--select referee--</option>
                                    @foreach($referee->where('referee_type','assistant referee') as $ref)
                                        <option value="{{ $ref->id }}" {{--{{ in_array($ref->id, (array) old('referee_id')) ? 'selected' : '' }}--}}>{{ $ref->name . " " . $ref->last_name }}</option>                                    
                                    @endforeach
                                </select>
                                @error('referee_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4">Assistant Referee <span class="text-red-500">*</span></label>
                                <select name="referee_id[]" id="assistantReferee2" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">--select referee--</option>
                                    @foreach($referee->where('referee_type','assistant referee') as $ref)
                                        <option value="{{ $ref->id }}" {{--{{ in_array($ref->id, (array) old('referee_id')) ? 'selected' : '' }}--}}>{{ $ref->name . " " . $ref->last_name }}</option>                                    
                                    @endforeach
                                </select>
                                @error('referee_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>                           
                            <div  class="w-full md:w-1/2 px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Fourth Referee <span class="text-red-500">*</span></label>
                                <select name="referee_id[]" id="description" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">--select referee--</option>
                                    @foreach($referee->where('referee_type','fourth referee') as $ref)
                                        <option value="{{ $ref->id }}" {{--{{ in_array($ref->id, (array) old('referee_id')) ? 'selected' : '' }}--}}>{{ $ref->name . " " . $ref->last_name }}</option>                                    
                                    @endforeach
                                </select>
                                @error('referee_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div  class="w-full px-3">
                                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 mt-4" >Description</label>
                                <textarea name="description" id="description" class="block uppercase tracking-wide appearance-none w-full shadow border rounded py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            </div>
                            <input value="{{ old('id',$tournament->id) }}" type="hidden" name="tournament_id">
                            @error('tournament_id')
                                    <div class="flex items-center bg-trasparent text-red-500 text-sm font-bold px-4 py-3" role="alert">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            <div class="flex items-center justify-between">
                                <button type="submit" class="button px-6 mx-3 mt-6">Save</button>                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#team_local_id').change(function() {
            var selectedTeam = $(this).find('option:selected');
            var stadiumId = selectedTeam.data('stadium_id');
            var stadiumName = selectedTeam.data('stadium_name');
        
            $('#stadium_id').val(stadiumId);
            $('#stadium_name').val(stadiumName);

            // Filtrar opciones del select de equipo visitante
            let selectedTeamId = $(this).val();
            $('#team_visitor_id option').show();
            $('#team_visitor_id option[value="' + selectedTeamId + '"]').hide();

            // Habilitar el select de equipo visitante
            $('#team_visitor_id').prop('disabled', false);
        });

        // Mantener habilitado el select de equipo visitante una vez seleccionado un equipo
        $('#team_visitor_id').change(function() {
            if ($(this).val() !== '') {
                $(this).prop('disabled', false);
            }
        });

        // Inicializar el select de equipo visitante al cargar la página
        let initialTeamVisitorValue = $('#team_visitor_id').val();
        if (initialTeamVisitorValue !== '') {
            $('#team_visitor_id').prop('disabled', false);
        }

        // Script para que al seleccionar un árbitro asistente no vuelva a mostrarse en el siguiente select
        let selectedRefereeIds = [];
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




