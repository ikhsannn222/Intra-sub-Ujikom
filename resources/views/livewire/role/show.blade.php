<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('role.index') }}">Role</a></li>
            <li><a class="text-black-400 font-semibold">Detail data Role</a></li>
        </ul>
    </div>
    <a href="{{ route('role.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <div class="mb-8 md:grid-cols-2 mt-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col">
            <h4 class="mb-4 font-semibold text-black-600 dark:text-black-300">
                Detail Role
            </h4>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>ID:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Role Name:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $role->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Permission:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-600">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 ">
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center dark:text-white">
                                        @if ($role->hasPermissionTo($permission->name))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                        <span class="ml-2 text-sm dark:text-gray-400 text-gray-600">{{ $permission->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
