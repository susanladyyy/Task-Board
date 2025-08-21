<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Validation\Rule;

class ProjectTasks extends Component
{
    public $newTaskName = '';
    public $editTaskId = null;
    public $editTaskName = '';
    public $currentProjectId = null;
    public $showInput = false;
    public $showUpdInput = false;

    public function render() {
        $projects = Project::with(['tasks' => function($query) {
            $query->orderBy('priority', 'asc');
        }])->get();

        return view('livewire.project-tasks', [
            'projects' => $projects,
        ]);
    }

    public function setCurrentProject($projectId) {
        $this->currentProjectId = $projectId;
        $this->newTaskName = '';
    }

    public function storeTask($projectId) {
        $this->validate([
            'newTaskName' => 'required|string|max:255',
        ]);

        $project = Project::find($projectId);
        if (!$project) {
            session()->flash('error', 'Project not found.');
            return;
        }

        $maxOrder = $project->tasks()->max('priority');
        $newOrder = $maxOrder !== null ? $maxOrder + 1 : 0;

        $project->tasks()->create([
            'task_name' => $this->newTaskName,
            'priority' => $newOrder,
        ]);

        $this->newTaskName = '';
        $this->dispatch('task-created');
        $this->toggleInput();
    }

    public function editTask($taskId, $taskName) {
        $task = Task::findOrFail($taskId);
        $this->editTaskId = $task->id;
        $this->newTaskName = $task->task_name;
    }

    public function updateTask($taskId) {
        $this->validate([
            'editTaskName' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($this->editTaskId);
        $task->task_name = $this->editTaskName;
        $task->save();

        $this->editTaskId = null;
        $this->editTaskName = '';
    }

    public function cancelEdit() {
        $this->editTaskId = null;
        $this->editTaskName = '';
        $this->currentProjectId = null;
    }

    public function deleteTask($taskId, $projectId) {
        $task = Task::findOrFail($taskId);
        $projectId = $task->project_id;
        $task->delete();

        $remainingTasks = Task::where('project_id', $projectId)->orderBy('priority', 'asc')->get();

        foreach ($remainingTasks as $index => $task) {
            $task->priority = $index + 1;
            $task->save();
        }
    }

    public function updateTaskOrder($projectId, $taskIds) {
        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
    }

    public $openProjectIds = [];

    public function toggleAccordion($projectId) {
        if (in_array($projectId, $this->openProjectIds)) {
            $this->openProjectIds = array_diff($this->openProjectIds, [$projectId]);
        } else {
            $this->openProjectIds[] = $projectId;
        }
    }

    public function toggleInput() {
        $this->showInput = !$this->showInput;
    }
}
