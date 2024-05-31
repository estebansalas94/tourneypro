

<x-app-layout>
    <x-slot name="header">
        <img src="{{  asset('storage/img/arbitro.png') }}" alt="Perfil image" width="10%" class="rounded-full" style="display: block; margin: 0 auto;">
        <div class="mb-0 p-0">
            <a href="{{ route('referees.create') }}" class="material-symbols-outlined cursor-pointer text-blue-500 text-4xl hover:text-white">
                add_box
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                Referee Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nationality
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($referees as $referee)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-4 py-4 ">
                                    <img src="{{  asset('storage/images/referees').'/'.$referee->image }}" alt="Perfil image" width="20%" class="w-14 h-14 object-cover rounded-full">
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium uppercase text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="#">{{ $referee->name }}</a>
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium uppercase text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $referee->last_name }}
                                </th>
                                <td class="px-6 py-4 uppercase">
                                    {{  $referee->referee_type }}
                                </td>
                                <td class="px-6 py-4 uppercase">
                                    {{  $referee->nationality }}
                                </td>
                                <td class="px-6 py-4 uppercase">
                                    {{  $referee->description }}
                                </td>
                                <td class="px-3 py-2">
                                    <a href="{{ route('referees.edit',$referee) }}" class="material-symbols-outlined cursor-pointer text-blue-600 font-bold hover:scale-110 text-2xl active:text-white  rounded focus:outline-none focus:shadow-outline">Edit</a>
                                    <button type="button" onclick="confirmarDelete({{ $referee->id }})" class=" material-symbols-outlined cursor-pointer font-bold text-red-700 text-2xl active:text-white transform hover:scale-110 rounded focus:outline-none focus:shadow-outline">
                                        Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div>
                    {{ $referees->links() }}
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
                form.action = `/referees/${id}`
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


