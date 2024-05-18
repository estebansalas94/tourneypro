<x-app-layout>
  <x-slot name="header">
      <a href="{{ route('tournaments.index') }}" class="material-symbols-outlined cursor-pointer text-white text-2xl active:text-white transform hover:scale-110 absolute top-12 left-2 ml-5 mt-5">Home</a>
      <button type="button" onclick="confirmarDelete({{ $tournament->id }})" class="material-symbols-outlined cursor-pointer text-red-700 text-2xl active:text-red-900 transform hover:scale-110 absolute top-12 right-2 mr-5 mt-5">Delete</button>
      <div class="bg-gray-200 dark:bg-gray-800 h-32 rounded-lg flex items-center justify-center text-gray-500">
          <img src="{{ asset('storage/images/tournaments/' . $tournament->image) }}" alt="Tournament Image" class="h-full rounded-lg">
      </div>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $tournament->name }} 
          <a href="{{ route('tournaments.edit', $tournament) }}" class="material-symbols-outlined p-2 text-blue-400 transform hover:scale-110">border_color</a>
      </h2>
      <div class="mb-4 p-0">
          <a href="{{ route('tournaments.teams', $tournament->id) }}" class="material-symbols-outlined cursor-pointer bg-blue-500 hover:bg-blue-700 active:bg-green-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute top-12 right-8 mr-1 mt-44">lists</a>
      </div>
  </x-slot>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <form action="{{ route('tournaments.select-teams', $tournament->id) }}" method="GET" class="px-0 w-full max-w-[430px] mb-4">
                      <div class="relative">
                          <input
                              type="search"
                              name="search"
                              id="default-search"
                              placeholder="Search"
                              value="{{ request('search') }}"
                              required
                              class="block w-full p-4 py-5 pl-10 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                          />
                          <button
                              type="submit"
                              class="absolute right-2.5 bottom-1/2 transform translate-y-1/2 p-4 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700"
                          >
                              <svg
                                  viewBox="0 0 20 20"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                  aria-hidden="true"
                                  class="w-4 h-4"
                              >
                                  <path
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                      stroke-width="2"
                                      stroke-linejoin="round"
                                      stroke-linecap="round"
                                      stroke="currentColor"
                                  ></path>
                              </svg>
                              <span class="sr-only">Search</span>
                          </button>
                      </div>
                  </form>
                  <div class="mb-4">
                      <a href="{{ route('teams.create') }}" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create New Teams</a>
                  </div>
                  <form action="{{ route('tournaments.store-selected-teams', $tournament->id) }}" method="POST">
                      @csrf

                      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                            <th scope="col" class="px-6 py-3">Select</th>
                              <th scope="col" class="px-6 py-3">Team Name</th>
                              <th scope="col" class="px-6 py-3">Coach Name</th>
                              <th scope="col" class="px-2 py-3">Shield</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($teams as $team)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                              <td class="px-6 py-3">
                                <label class="cyberpunk-checkbox-label">
                                  <input type="checkbox" class="cyberpunk-checkbox" name="team_ids[]" value="{{ $team->id }}">
                                </label>
                              </td>
                              <td class="px-6 py-3">{{ $team->name }}</td>
                              <td class="px-6 py-3">{{ $team->coach_name }}</td>
                              <td class="px-2 py-3">
                                <img src="{{ asset('/storage/images/teams/' . $team->shield) }}" alt="Team shield" class="w-14 h-14 object-cover rounded-full">
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="py-6">
                          <button type="submit" class="button">Save</button>
                      </div>
                  </form>
              </div>                  
          </div>
      </div>
  </div>
</x-app-layout>
