<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTask() {
        $tasks = Task::all();

        return view('home', ['tasks' => $tasks]);
    }

    public function updateTask() {
        
    }

    public function deleteTask($taskId) {
        Task::where('id', $taskId)->delete();
        return view('home', ['message' => 'Task deleted successfully!']);
    }
}
