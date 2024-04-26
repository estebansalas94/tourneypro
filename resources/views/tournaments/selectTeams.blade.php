<h1>Seleccionar Equipos para el Torneo</h1>



<form action="{{ route('tournaments.store-selected-teams', $tournament->id) }}" method="POST">
    @csrf
    @foreach($teams as $team)
        <input type="checkbox" name="team_ids[]" value="{{ $team->id }}"> {{ $team->name }} <br>
    @endforeach
    <button type="submit">Guardar Equipos</button>
</form>
