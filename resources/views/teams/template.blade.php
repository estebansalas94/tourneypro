
<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('teams.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
        <button type="button" onclick="confirmarDelete({{ $team->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
        <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
            <img src="{{ Storage::url('images/teams/' . $team->shield) }}" alt="Tournament Image" class="h-full rounded-lg  ">
        </div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $team->name }}   <a href="{{ route('teams.edit', $team) }}" class="material-symbols-outlined p-2 text-blue-400 transform hover:scale-110">border_color</a></h2>
        <div class="mb-4 p-0">
            <a href="{{ route('templates.created', ['team' => $team->id]) }}" class="bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-2 mr-5 mt-44">ADD</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Last name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dorsal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Position
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nationality
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Age
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($templates as $template)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-4 py-4 ">
                                    <img src="{{  asset('/storage/images/templates').'/'.$template->image }}"alt="Perfil image" width="20%" class="rounded-full">
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="#">{{ $template->name }}</a>
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $template->last_name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{  $template->dorsal }}
                                </td>
                                <td class="px-6 py-4">
                                    {{  $template->position }}
                                </td>
                                <td class="px-6 py-4">
                                    {{  $template->nationality }}
                                </td>
                                <td class="px-6 py-4">
                                    {{  $ages[$loop->index] }}
                                </td>
                                <td class="px-3 py-2">
                                    <a href="{{ route('templates.edit', $template) }}" class="material-symbols-outlined cursor-pointer text-blue-600 font-bold hover:scale-110 text-2xl active:text-white  rounded focus:outline-none focus:shadow-outline">Edit</a>
                                    <button type="button" onclick="confirmarDelete({{ $template->id }})" class=" material-symbols-outlined cursor-pointer font-bold text-red-700 text-2xl active:text-white transform hover:scale-110 rounded focus:outline-none focus:shadow-outline">
                                        Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

