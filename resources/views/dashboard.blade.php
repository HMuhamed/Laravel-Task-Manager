<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="{{ asset('css/dashboard_styles.css') }}" rel="stylesheet">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="task-controls">
    <form action="{{ route('dashboard') }}" method="GET" class="flex gap-4 items-center">
    <a href="{{ route('task.create') }}" class="btn btn-primary">Create a Task</a>
        <div>
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-select">
                <option value="">All</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Complete</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Incomplete</option>
            </select>
        </div>

        <div>
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" class="form-select">
                <option value="">All</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>High</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    
</div>


                    </div>

                    <table class="task-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>
                                    @if($task->status)  
                                        Complete
                                    @else   
                                        Incomplete
                                    @endif 
                                    </td>
                                    <td> 
                                    @if($task->priority == 1)
                                        High
                                    @elseif($task->priority == 2) 
                                        Medium
                                    @elseif($task->priority == 3)
                                        Low
                                    @else
                                        N/A
                                    @endif
                                    </td>
                                    <td>
    <a href="{{ route('task.view', ['task' => $task]) }}" class="btn btn-view">View</a>
</td>

                                    <td>
                                        <a href="{{ route('task.edit', ['task' => $task]) }}" class="btn btn-edit">Edit</a>
                                    </td>
                                    <td>
                       <button class="btn btn-delete" onclick="showDeleteModal({{ $task->id }})">Delete</button>
                       <div id="modal-{{ $task->id }}" class="modal-overlay">
                       <div class="modal-content">
            <h3>Are you sure you want to delete this task?</h3>
            <p>This action cannot be undone.</p>
            <form method="post" action="{{ route('task.destroy', ['task' => $task]) }}" id="delete-form-{{ $task->id }}">
                @csrf
                @method('delete')
                <div>
                    <button type="button" onclick="closeDeleteModal({{ $task->id }})" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function showDeleteModal(taskId) {
        document.getElementById('modal-' + taskId).style.display = 'flex';
    }

    function closeDeleteModal(taskId) {
        document.getElementById('modal-' + taskId).style.display = 'none';
    }
</script>

