<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TodoList extends Component
{
    public $newTask = '';
    public $dueDate = '';
    public $priority = 'low'; // Default priority

    public $editingTaskId = null;
    public $taskBeingEdited = '';

    // Add a task to the database
    public function addTask()
    {
        if (trim($this->newTask) === '') return;

        Task::create([
            'title' => $this->newTask,
            'completed' => false,
            'due_date' => $this->dueDate ?: null,
            'priority' => $this->priority ?: 'low',
        ]);

        // Reset input fields
        $this->newTask = '';
        $this->dueDate = '';
        $this->priority = 'low';
    }

    // Delete task from database
    public function deleteTask($id)
    {
        Task::find($id)?->delete();
    }

    // Start editing a task
    public function startEditing($id)
    {
        $task = Task::find($id);
        $this->editingTaskId = $id;
        $this->taskBeingEdited = $task->title;
    }

    // Save edited task
    public function saveTask()
    {
        $task = Task::find($this->editingTaskId);
        if ($task) {
            $task->title = $this->taskBeingEdited;
            $task->save();
        }

        $this->editingTaskId = null;
        $this->taskBeingEdited = '';
    }

    // Toggle task completion in the database
    public function toggleCompleted($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->completed = !$task->completed;
            $task->save();
        }
    }

    // Render the component view with live tasks from DB
    public function render()
    {
        return view('livewire.todo-list', [
            'tasks' => Task::orderByDesc('created_at')->get()
        ]);
    }
}
