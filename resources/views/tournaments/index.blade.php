<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-0">
            {{ __('TOURNAMENTS') }}
        </h2>
        <div class="mb-0 p-0">
            <a href="{{ route('tournaments.create') }}" class="material-symbols-outlined cursor-pointer text-blue-500 text-7xl hover:text-white">
                add_box
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($tournaments as $tournament)
                        <div class="bg-gray-800 p-8">
                            <a href="{{ route('tournaments.show',$tournament) }}" class="" style="display: inline-block; inline-size: 100%; block-size: 100%;">
                                <span class="text-center text-white">{{ $tournament->name }}</span>
                                <img id="image" src="{{ asset('/storage/images/tournaments').'/'.$tournament->image }}" alt="Image 1" class="w-full h-auto rounded-md" style="display: inline-block; inline-size: 100%; block-size: 100%;">
                            </a>

                            {{-- <form action="{{ route('tournaments.restore', $tournament->id) }}" method="POST" style="display: inline-block">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-success" value="Restaurar">
                            </form>

                            <form action="{{ route('tournaments.forceDelete', $tournament->id) }}" method="POST" style="display: inline-block">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-success" value="Eliminar">
                            </form> --}}

                            <a href="{{ route('tournaments.edit', $tournament) }}" class="bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                            <button type="button" onclick="confirmarDelete({{ $tournament->id }})" class="bg-red-500 hover:bg-red-700 active:bg-red-200 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete</button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div>
                    {{ $tournaments->links() }}
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!--script de confirmar delete con alertifyjs-->
<script>
    function confirmarDelete(id){
        alertify.confirm("This is a confirm dialog.", function (e){
            if(e){
                let form = document.createElement('form')
                form.method = 'POST'
                form.action = `/tournaments/${id}`
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
