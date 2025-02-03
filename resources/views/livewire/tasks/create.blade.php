<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('tasks.index') }}">Task</a></li>
            <li><a class="text-black-400 font-semibold">Add data Task</a></li>
        </ul>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Task
    </h2>

    <form wire:submit.prevent="store">
        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <!-- Task Name -->
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Task Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert task name" wire:model="name" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>

            <!-- Task Content -->
            <div>
                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Content</span>
                </label>

                <!-- Integrasi CKEditor -->
                <div wire:ignore>
                    <textarea wire:model.defer="content"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2 min-h-fit h-48"
                        name="content" id="content"></textarea>
                </div>

                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Owner -->
            <label for="owner_id" class="block text-sm mt-4">Owner</label>
            <select wire:model="owner_id" id="owner_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Owner</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('owner_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Responsible -->
            <label for="responsible_id" class="block text-sm mt-4">Responsible</label>
            <select wire:model="responsible_id" id="responsible_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Responsible</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('responsible_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Status -->
            <label for="status_id" class="block text-sm mt-4">Status</label>
            <select wire:model="status_id" id="status_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
            @error('status_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Project -->
            <label for="project_id" class="block text-sm mt-4">Project</label>
            <select wire:model="project_id" id="project_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            @error('project_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Task Type -->
            <label for="type_id" class="block text-sm mt-4">Task Type</label>
            <select wire:model="type_id" id="type_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Task Type</option>
                @foreach ($taskType as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Start Date -->
<label class="block text-sm mt-4">
    <span class="text-gray-700 dark:text-gray-400">Start Date</span>
    <input
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
        type="date" wire:model="start_date" />
    @error('start_date')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</label>

<!-- End Date -->
<label class="block text-sm mt-4">
    <span class="text-gray-700 dark:text-gray-400">End Date</span>
    <input
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
        type="date" wire:model="end_date" />
    @error('end_date')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</label>


            <!-- Priority -->
            <label for="priority_id" class="block text-sm mt-4">Priority</label>
            <select wire:model="priority_id" id="priority_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Priority</option>
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach
            </select>
            @error('priority_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Code -->
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Task Code</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert task code" type="text" wire:model="code" />
                @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>

            <!-- Order -->
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Task Order</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert task order" type="number" wire:model="order" />
                @error('order')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>

            <!-- Estimation -->
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Estimation (hours)</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert estimation hours" type="number" wire:model="estimation" />
                @error('estimation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button type="reset" class="btn btn-md btn-warning text-white">Reset</button>
        <button type="submit" class="btn btn-md btn-primary">Save</button>
    </form>
    {{-- <script>
  tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Dec 4, 2024:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      // Early access to document converters
      'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    exportpdf_converter_options: { 'format': 'Letter', 'margin_top': '1in', 'margin_right': '1in', 'margin_bottom': '1in', 'margin_left': '1in' },
    exportword_converter_options: { 'document': { 'size': 'Letter' } },
    importword_converter_options: { 'formatting': { 'styles': 'inline', 'resets': 'inline',	'defaults': 'inline', } },
  });
</script> --}}

</div>
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData()); // Sinkronkan dengan $content
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
