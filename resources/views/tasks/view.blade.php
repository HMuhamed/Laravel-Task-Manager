<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>
    @push('styles')
        <link href="{{ asset('css/view_task.css') }}" rel="stylesheet">
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

                    <table class="task-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            </tr>
                        </tbody>
                    </table>
                    <div class="task-controls">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
