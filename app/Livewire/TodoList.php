<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TodoList extends Component
{

    public function createNewUser() {
        User::create([
            'name' => "test user",
            'email' => "test@test.com",
            'password' => '1234567890'
        ]);
    }

    public function render()
    {
        $title = "This is a string.";
        $users = User::all();

        return view('livewire.todo-list',[
            'title' => $title,
            'users' => $users
        ]);
    }
}
