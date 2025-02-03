<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('project.index') }}">Project</a></li>
            <li><a class="text-black-400 font-semibold">Add data Project</a></li>
        </ul>
    </div>
    <a href="{{ route('project.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Project
    </h2>

    <form wire:submit.prevent="store">
        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Nama Project -->
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert name project" wire:model="name" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>

            <!-- Deskripsi Project -->
            {{-- <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">Description</span>
                <textarea id="description" name="description" rows="4" wire:model="description"
                    class="shadow-sm focus:ring-indigo-500 dark:text-400 dark:bg-white-700 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                    placeholder="insert project description"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label> --}}

             <div>
                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Descripion</span>
                </label>

                <!-- Integrasi CKEditor -->
                <div wire:ignore>
                    <textarea wire:model.defer="description"
                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2 min-h-fit h-48"
                              name="description"
                              id="description"></textarea>
                </div>

                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <!-- Owner Project -->
            <!-- Owner -->
            <label for="owner_id" class="block text-sm mt-4 text-gray-700 dark:text-gray-400">Owner</label>
            <select wire:model="owner_id" id="owner_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Pilih Pemilik</option>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                @endforeach
            </select>
            @error('owner_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror



            <!-- Status Project -->
            <label for="status_id" class="block text-sm mt-4 text-gray-700 dark:text-gray-400">Status</label>
            <select wire:model="status_id" id="status_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Pilih Status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @error('status_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Cover Image -->
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Cover</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    type="file" wire:model="cover_image" />
                @error('cover_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>

            <!-- Ticket Prefix -->
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Ticket Prefix</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert ticket prefix" type="number" wire:model="ticket_prefix" />
                @error('ticket_prefix')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <button type="reset" class="btn btn-md btn-warning text-wh">Reset</button>
        <button type="submit" class="btn btn-md btn-primary">Save</button>
    </form>
</div>

@push('scripts')


<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
