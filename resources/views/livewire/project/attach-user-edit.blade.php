<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

     <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('project.index') }}">Project</a></li>
            <li><a href="{{ route('project.show', ['projectId' => $this->projects_id]) }}">Detail data Project</a></li>
            <li><a class="text-gray-400 font-semibold">Edit Attach User</a></li>
        </ul>
    </div>
    <a href="{{ route('project.show', ['projectId' => $this->projects_id]) }}"
        class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Attach user
    </h2>
    <form wire:submit.prevent="update" class="space-y-4">
        <label for="users_id" class="block text-sm mt-4 text-gray-700 dark:text-gray-400">Attach User</label>
        <select wire:model="users_id" id="users_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
            <option value="">Choose User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('users_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn btn-md btn-primary mt-2">Update Attach User</button>
    </form>
</div>
