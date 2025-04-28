<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-4">📝 To-Do List</h1>

    <form wire:submit.prevent="addTask" class="flex space-x-2 mb-4">
        <input type="text" wire:model="newTask" class="flex-grow border rounded px-3 py-2" placeholder="Add a new task">
        <input type="date" wire:model="dueDate" class="border rounded px-3 py-2">
        <select wire:model="priority" class="border rounded px-3 py-2">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add</button>
    </form>    

    <ul>
        @foreach ($tasks as $task)
            <li class="flex justify-between items-center border-b py-2">
                @if($editingTaskId === $task['id'])
                    <input wire:model="taskBeingEdited" type="text" class="border rounded px-3 py-2">
                    <button wire:click="saveTask" class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                @else
                    <div class="{{ $task['completed'] ? 'line-through text-gray-500' : '' }} 
                        {{ $task['priority'] === 'high' ? 'text-red-500' : '' }} 
                        {{ $task['priority'] === 'medium' ? 'text-yellow-500' : '' }} 
                        {{ $task['priority'] === 'low' ? 'text-green-500' : '' }}">
                        {{ $task['title'] }}
                    </div>

                    <div class="flex items-center space-x-2">
                        <button wire:click="startEditing({{ $task['id'] }})" class="text-blue-500 hover:text-blue-700">✎</button>
                        <input type="checkbox" wire:click="toggleCompleted({{ $task['id'] }})" {{ $task['completed'] ? 'checked' : '' }}>
                        <button wire:click="deleteTask({{ $task['id'] }})" class="text-red-500 hover:text-red-700">✖</button>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>    
</div>
