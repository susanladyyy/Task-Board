<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            "project_id" => 1,
            "task_name" => "Critical Bug Fix (Production)",
            "priority" => 1,
        ]);
        Task::create([
            "project_id" => 1,
            "task_name" => "Security Patch Implementation",
            "priority" => 2,
        ]);
        Task::create([
            "project_id" => 1,
            "project_id" => 1,
            "task_name" => "New Feature Development (Core)",
            "priority" => 3,
        ]);
        Task::create([
            "project_id" => 1,
            "task_name" => "Performance Optimization",
            "priority" => 4,
        ]);
        Task::create([
            "project_id" => 1,
            "task_name" => "Minor Bug Fix",
            "priority" => 5,
        ]);
        Task::create([
            "project_id" => 2,
            "task_name" => "Refactoring (Technical Debt)",
            "priority" => 1,
        ]);
        Task::create([
            "project_id" => 2,
            "task_name" => "User Interface (UI) Improvements",
            "priority" => 2,
        ]);
        Task::create([
            "project_id" => 2,
            "task_name" => "Documentation Updates",
            "priority" => 3,
        ]);
        Task::create([
            "project_id" => 2,
            "task_name" => "Internal Tooling Development",
            "priority" => 4,
        ]);
        Task::create([
            "project_id" => 2,
            "task_name" => "Research & Exploration",
            "priority" => 5,
        ]);
    }
}
