<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function dashboard(Request $request)
    {
        $tasks = Task::where('user_id', auth()->id())
            ->when($request->status !== null, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->priority !== null, function ($query) use ($request) {
                return $query->where('priority', $request->priority);
            })
            ->orderBy('id', 'desc')
            ->get();
    
        return view('dashboard', compact('tasks'));
    }
    public function create(){
        return view('tasks.create');
    }
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'status' => 'required|boolean',
        'priority' => 'nullable|integer|in:1,2,3',
    ]);
    $data['user_id'] = auth()->id();

    $newTask = Task::create($data);

    return redirect(route('dashboard'))->with('success', 'Task created successfully!');
}
public function show(Task $task)
{
    return view('tasks.view', ['task' => $task]);
}
public function edit(Task $task){
    return view('tasks.edit', ['task' => $task]);
}
public function update(Task $task, Request $request){
    $data = $request->validate([
       'title' => 'required|string',
        'description' => 'required|string',
        'status' => 'required|boolean',
        'priority' => 'nullable|integer|in:1,2,3',
    ]);

    $task->update($data);

    return redirect(route('dashboard'))->with('success', 'Task Updated Succesffully');

}
public function destroy(Task $task){
    $task->delete();
    return redirect(route('dashboard'))->with('success', 'Task deleted Succesffully');
}
}
