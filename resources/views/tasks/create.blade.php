<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="{{ asset('css/create_task.css') }}" rel="stylesheet">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="task-form-container">
                        <h1>Create a Task</h1>

                        @if(session()->has('success'))
                            <div class="alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('task.store') }}" onsubmit="return validateForm()">
                            @csrf
                            @method('post')

                            <div>
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" placeholder="Task Title" />
                                <span id="title-error" class="error-message"></span>
                            </div>
                            <div>
                                <label for="description">Description <span class="required">*</span></label>
                                <textarea id="description" name="description" placeholder="Task Description"></textarea>
                                <span id="description-error" class="error-message"></span>
                            </div>
                            <div>
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="0">Incomplete</option>
                                    <option value="1">Complete</option>
                                </select>
                            </div>
                            <div>
                                <label for="priority">Priority</label>
                                <select id="priority" name="priority">
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                            </div>
                            <div>
                                <input type="submit" value="Save Task" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function validateForm() {
        let isValid = true;

        const title = document.getElementById('title');
        const description = document.getElementById('description');
        const titleError = document.getElementById('title-error');
        const descriptionError = document.getElementById('description-error');

        titleError.textContent = '';
        descriptionError.textContent = '';

        if (!title.value.trim()) {
            titleError.textContent = 'Title is required.';
            isValid = false;
        }

        if (!description.value.trim()) {
            descriptionError.textContent = 'Description is required.';
            isValid = false;
        }

        return isValid;
    }
</script>


