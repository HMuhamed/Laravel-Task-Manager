<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="{{ asset('css/edit_task.css') }}" rel="stylesheet">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center mb-6 text-xl font-semibold text-gray-800">{{ __('Edit a Task') }}</h1>

                    <div>
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="task-form-container">
                        <form method="post" action="{{ route('task.update', ['task' => $task]) }}" onsubmit="return validateEditForm()">
                            @csrf
                            @method('put')

                            <div class="input-container">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" placeholder="Task Title" value="{{ $task->title }}"  />
                                <span id="title-error" class="error-message"></span>
                            </div>

                            <div class="input-container">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" placeholder="Task Description">{{ $task->description }}</textarea>
                                <span id="description-error" class="error-message"></span>
                            </div>

                            <div class="input-container">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Incomplete</option>
                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Complete</option>
                                </select>
                            </div>

                            <div class="input-container">
                                <label for="priority">Priority</label>
                                <select id="priority" name="priority">
                                    <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
                                    <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
                                </select>
                            </div>

                            <div>
                                <input type="submit" value="Update Task" class="submit-button" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function validateEditForm() {
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

