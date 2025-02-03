<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('priorities.index') }}">Task Priority</a></li>
            <li><a class="text-black-400 font-semibold">Detail data Task Priority</a></li>
        </ul>
    </div>
    <a href="{{ route('priorities.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <div class="mb-8 md:grid-cols-2 mt-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                Detail Task Priorities
            </h4>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Name:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            {{ $prioritas->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Color:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div style="width: 25px; height: 25px; background-color: {{ $prioritas->color }}; border-radius: 3px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                            <strong>Default:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400 flex items-center">
                            {{ $prioritas->is_default ? 'Ya' : 'Tidak' }}
                            <span class="mx-2">|</span>
                            @if ($prioritas->is_default == 1)
                                <i class='bx bxs-check-circle text-2xl text-green-500'></i>
                            @else
                                <i class='bx bxs-x-circle text-2xl text-red-500'></i>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
