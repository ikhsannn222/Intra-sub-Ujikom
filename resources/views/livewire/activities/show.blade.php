<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('activities.index') }}">Activities</a></li>
            <li><a class="text-gray-400 font-semibold">Detail data Activities</a></li>
        </ul>
    </div>
    <a href="{{ route('activities.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <div class="mb-8 md:grid-cols-2 mt-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                Detail Activities
            </h4>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            <strong>Name:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ $aktivitas->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            <strong>Descripion:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ $aktivitas->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
