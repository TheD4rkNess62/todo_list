<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TodoList extends Component
{
    public $tasks = [];
    public $newTask = '';

    // Load tasks from the database
    public function mount()
    {
        $this->tasks = Task::all()->toArray(); // Load tasks from DB
    }

    // Add a task to the database
    public function addTask()
    {
        if (trim($this->newTask) === '') return;

        $task = Task::create([
            'title' => $this->newTask,
            'completed' => false,
        ]);

        // Add to the tasks array for the UI update
        $this->tasks[] = $task->toArray();
        $this->newTask = '';
    }

    // Delete a task from the database
    public function deleteTask($id)
    {
        Task::find($id)->delete();
        $this->tasks = Task::all()->toArray(); // Reload tasks from DB
    }

    // Toggle task completion in the database
    public function toggleCompleted($id)
    {
        $task = Task::find($id);
        $task->completed = !$task->completed;
        $task->save();

        $this->tasks = Task::all()->toArray(); // Reload tasks
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}