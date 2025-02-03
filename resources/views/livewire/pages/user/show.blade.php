<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('user.index') }}">User</a></li>
            <li><a class="text-black-400 font-semibold">Detail data User</a></li>
        </ul>
    </div>
    <a href="{{ route('user.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <div class="mb-8 md:grid-cols-2 mt-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-black-800 flex flex-col">
            <h4 class="mb-4 font-semibold text-black-600 dark:text-black-300">
                Detail User
            </h4>
            <div class="flex justify-center mb-4">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                        class="h-60 w-30 rounded-full" />
                @else
                     <div class="inline-flex items-center justify-center w-40 h-40 overflow-hidden bg-indigo-500 rounded-full dark:bg-indigo-500">
                        <span class="text-sm font-medium text-white dark:text-black-300">
                             {{ strtoupper(substr($user->name, 0, 2)) }}
                        </span>
                    </div>
                @endif
            </div>
            <table class="min-w-full divide-y divide-black-200">
                <tbody class="bg-white divide-y divide-black-200 dark:bg-black-700 dark:divide-black-600">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Name:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>NRP:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->nrp }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>E-mail:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Status:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->is_active ? 'Aktif' : 'Non-aktif' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Departemen  :</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->departement->name ?? 'Tidak ada departemen' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Jabatan:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->jabatan->name ?? 'Tidak ada jabatan' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Bagian:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->bagian->name ?? 'Tidak ada bagian' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Role:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $user->getRoleNames()->implode(', ') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
