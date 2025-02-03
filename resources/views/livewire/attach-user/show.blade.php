<div>
    <div class="mb-8 md:grid-cols-2 mt-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                Detail Attach User
            </h4>
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            <strong>User:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ optional($users->firstWhere('id', $user_id))->name ?? 'Tidak ada user' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            <strong>Project:</strong>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                            {{ optional($projects->firstWhere('id', $project_id))->name ?? 'Tidak ada project' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="{{ route('attach-user.index') }}" class="btn btn-md btn-success text-white mt-4 justify-content-end"><< Back</a>
    </div>
</div>
