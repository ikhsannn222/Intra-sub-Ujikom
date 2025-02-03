    <div class="overflow-hidden">
        <aside class="flex z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 h-screen">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="/">
                    Intra-sub
                </a>
                <ul class="mt-6">
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-gray-200' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        <span
                            class="{{ request()->routeIs('welcome') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a wire:navigate.hover href="/"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150">
                            <i class="bx bxs-home" style="font-size: 20px;"></i>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>

                <ul class="pt-4 space-y-2 font-medium">
                    @can('manageUser')
                        <li class="px-6 py-2 font-semibold text-xs text-gray-600 dark:text-gray-400">USER MANAGEMENT</li>
                        <li
                            class="relative px-6 py-3 {{ request()->is('user*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('user*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
                                wire:navigate.hover href="{{ route('user.index') }}">
                                <i class='bx bxs-user' style="font-size: 20px;"></i>
                                <span class="ml-4">User</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                <ul>
                    @can('manageRole')
                        <li
                            class="relative px-6 py-3 {{ request()->is('role*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('role*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                wire:navigate.hover href="{{ route('role.index') }}">
                                <i class='bx bxs-user-check' style="font-size: 24px;"></i>
                                <span class="ml-4">Role</span>
                            </a>
                        </li>
                    @endcan
                </ul>

                <ul>
                    @can('managePermission')
                        <li
                            class="relative px-6 py-3 {{ request()->is('permissions*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('permissions*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                wire:navigate.hover href="{{ route('permission.index') }}">
                                <i class='bx bxs-check-square' style="font-size: 20px;"></i>
                                <span class="ml-4">Permission</span>
                            </a>
                        </li>
                        <li class="border-t border-gray-200 dark:border-gray-700"></li>
                    @endcan
                </ul>


                <ul class="pt-4 mt-1 space-y-2 font-medium">
                    @can('manageDepartement')
                        <li class="px-6 py-2 font-semibold text-xs text-gray-600 dark:text-gray-400">ORGANIZATION MANAGEMENT
                        </li>
                        <li
                            class="relative px-6 py-3 {{ request()->is('departement*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('departement*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('departement.index') }}" wire:navigate.hover>
                                <i class='bx bxs-user-badge' style="font-size: 21px;"></i>
                                <span class="ml-4">Departement</span>
                            </a>
                        </li>
                    @endcan
                    @can('manageBagian')
                        <li
                            class="relative px-6 py-3 {{ request()->is('bagian*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('bagian*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('bagian.index') }}" wire:navigate.hover>
                                <i class='bx bxs-user-pin' style="font-size: 20px;"></i>
                                <span class="ml-4">Bagian</span>
                            </a>
                        </li>
                    @endcan
                    @can('manageJabatan')
                        <li
                            class="relative px-6 py-3 {{ request()->is('jabatan*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('jabatan*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('jabatan.index') }}" wire:navigate.hover>
                                <i class='bx bxs-user-rectangle' style="font-size: 20px;"></i>
                                <span class="ml-4">Jabatan</span>
                            </a>
                        </li>
                        <li class="border-t border-gray-200 dark:border-gray-700"></li>
                    @endcan
                </ul>

                <ul class="pt-4 mt-1 space-y-2 font-medium">
                    @can('manageTaskStatus')
                        <li class="px-6 py-2 font-semibold text-xs text-gray-600 dark:text-gray-400">TASK MANAGEMENT
                        </li>
                        <li
                            class="relative px-6 py-3 {{ request()->is('task-status*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('task-status*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('task-status.index') }}" wire:navigate.hover>
                                <i class='bx bxs-check-circle ' style="font-size: 20px;"></i>
                                <span class="ml-4">Task Status</span>
                            </a>
                        </li>
                    @endcan
                </ul>

                <ul>
                    @can('manageTaskType')
                        <li
                            class="relative px-6 py-3 {{ request()->is('task-type*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('task-type*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('task-type.index') }}" wire:navigate.hover>
                                <i class='bx bxs-purchase-tag' style="font-size: 20px;"></i>
                                <span class="ml-4">Task Type</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                <ul>
                    @can('manageTaskPriorities')
                        <li
                            class="relative px-6 py-3 {{ request()->is('priorities*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}"">
                            <span
                                class="{{ request()->is('priorities*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('priorities.index') }}" wire:navigate.hover>
                                <i class='bx bxs-flag-alt' style="font-size: 20px;"></i>
                                <span class="ml-4">Task Priorities</span>
                            </a>
                        </li>
                    @endcan
                </ul>

                <ul>
                    @can('manageProjectStatuses')
                        <li
                            class="relative px-6 py-3 {{ request()->is('statuses*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}"">
                            <span
                                class="{{ request()->is('statuses*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150"
                                href="{{ route('project-statuses.index') }}" wire:navigate.hover>
                                <i class='bx bx-check' style="font-size: 20px;"></i>
                                <span class="ml-4">Project Statuses</span>
                            </a>
                        </li>
                        <li class="border-t border-gray-200 dark:border-gray-700"></li>
                    @endcan
                </ul>

                <ul class="pt-4 mt-1 space-y-2 font-medium">
                    @can('manageProject')
                        <li class="px-6 py-2 font-semibold text-xs text-gray-600 dark:text-gray-400">
                            PROJECT MANAGEMENT
                        </li>
                        <li
                            class="relative px-6 py-3 {{ request()->is('project*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}"">
                            <span
                                class="{{ request()->is('project*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150"
                                href="{{ route('project.index') }}" wire:navigate.hover>
                                <i class='bx bxl-product-hunt' style="font-size: 20px;"></i>
                                <span class="ml-4">Project</span>
                            </a>
                        </li>
                    @endcan
                </ul>

                <ul>
                    @can('manageTasks')
                        <li
                            class="relative px-6 py-3 {{ request()->is('tasks*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            <span
                                class="{{ request()->is('tasks*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('tasks.index') }}" wire:navigate.hover>
                                <i class='bx bx-task' style="font-size: 20px"></i> <!-- Changed icon here -->
                                <span class="ml-4">Task</span>
                            </a>
                        </li>
                    @endcan
                    <li class="border-t border-gray-200 dark:border-gray-700"></li>
                </ul>
                <ul class="pt-4 mt-1 space-y-2 font-medium">
                    @can('manageBoard')
                        <li class="px-6 py-2 font-semibold text-xs text-gray-600 dark:text-gray-400">KANBAN BOARD
                        </li>
                        <li
                            class="relative px-6 py-3 {{ request()->is('board*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}"">
                            <span
                                class="{{ request()->is('board*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                href="{{ route('board.index') }}" wire:navigate.hover>
                                <i class='bx bxs-dashboard' style="font-size: 22px;"></i>
                                <span class="ml-4">Board</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                @if (!empty($projectId))
                    <ul>
                        @can('manageKanban')
                            <li
                                class="relative px-6 py-3 {{ request()->is('kanban*') ? 'text-blue-600 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                <span
                                    class="{{ request()->is('kanban*') ? 'absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                    aria-hidden="true"></span>
                                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('kanban.index', ['projectId' => $projectId ?? 'default']) }}"
                                    wire:navigate.hover>
                                    <i class='bx bx-table' style="font-size: 20px"></i> <!-- Changed icon here -->
                                    <span class="ml-4">Kanban</span>
                                </a>
                            </li>
                            <li class="border-t border-gray-200 dark:border-gray-700"></li>
                        @endcan
                    </ul>
                @endif
            </div>
        </aside>
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        </div>
        <aside
            class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    Intra-sub
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="index.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="forms.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="ml-4">Master User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
