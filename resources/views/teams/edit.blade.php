<x-app-layout class="dark">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-800 leading-tight">
            {{ __('Edit teams') }}
        </h2>

        <div class="mb-4 p-0">
            <a href="{{ route('teams.index') }}" class="bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"> Return Team </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="nya"> Team Name </label>
                            <input name="name" value="{{ old('name', $team->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white bg-gray-900  leading-tight focus:outline-none focus:shadow-outline" id="nya" type="text" placeholder="" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="nya"> Coach Name </label>
                            <input name="coach_name" value="{{ old('name', $team->coach_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white bg-gray-900  leading-tight focus:outline-none focus:shadow-outline" id="nya" type="text" placeholder="" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="mensaje"> Descriptión </label>
                            <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-white bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="mensaje" rows="5" placeholder="">{{ old('description',$team->description) }}</textarea>
                        </div>


                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Upload image</label>

                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-gray-900 border-4 border-dashed w-full h-32 hover:bg-gray-900 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center pt-7'>

                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>

                                        <p id="filename" class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Upload image</p>
                                    </div>
                                    <input name="shield" id="shield" type='file' class="hidden" />

                                </label>
                            </div>
                            <!-- Para ver la imagen previa-->
                            <div id="imagePreview" class="mt-2">
                                @if($team->shield)
                                    <div id="imagenSeleccionada" class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
                                        <img src="{{ Storage::url('images/teams/' . $team->shield) }}" alt="Tournament Image" class="h-full rounded-lg">
                                    </div>
                                @else
                                    <div id="imagenSeleccionada" class="bg-gray-200 h-32 rounded-lg flex items-center justify-center text-gray-500">
                                        No image available
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit"> Save </button>
                            <a href="{{ route('tournaments.index') }}" class="bg-red-500 hover:bg-red-700 active:bg-red-200 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Script para ver la imagen antes de gaurdar los datos -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        const uploadInput = $('#shield');
        const filenameLabel = $('#filename');
        const imagePreview = $('#imagenSeleccionada');

        uploadInput.change(function(){
            const file = this.files[0];

            if (file) {
                filenameLabel.text(file.name);

                let reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.html(`<img src="${e.target.result}" class="max-h-32 rounded-lg mx-auto" alt="Image preview" />`);
                }
                reader.readAsDataURL(file);
            } else {
                filenameLabel.text('Upload image');
                imagePreview.html('<div class="bg-gray-200 h-32 rounded-lg flex items-center justify-center text-gray-500">No image preview</div>');
            }
        });
    });
</script>
