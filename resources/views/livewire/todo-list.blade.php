<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-4">📝 To-Do List</h1>

    <form wire:submit.prevent="addTask" class="flex space-x-2 mb-4">
        <input type="text" wire:model="newTask" class="flex-grow border rounded px-3 py-2" placeholder="Add a new task">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add</button>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <li class="flex justify-between items-center border-b py-2">
                <div class="{{ $task['completed'] ? 'line-through text-gray-500' : '' }}">
                    {{ $task['title'] }}
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" wire:click="toggleCompleted({{ $task['id'] }})" {{ $task['completed'] ? 'checked' : '' }}>
                    <button wire:click="deleteTask({{ $task['id'] }})" class="text-red-500 hover:text-red-700">✖</button>
                </div>
            </li>
        @endforeach
    </ul>    
</div>
