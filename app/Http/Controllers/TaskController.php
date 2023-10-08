<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function list(): View
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        $userName = $authUser->name;
        $userId = $authUser->getKey();

        $tasks = $authUser->tasks()
            ->select(['id', 'title', 'description'])
            ->where('user_id', $userId)
            ->get()
            ->toArray();

        $responseData = [
            'tasks' => $tasks,
            'user_name' => $userName,
        ];

        return view('tasks.list', $responseData);
    }

    public function create(): RedirectResponse
    {
        $title = request()->input('title');
        $description = request()->input('description');

        /** @var User $authUser */
        $authUser = auth()->user();

        Task::query()
            ->create([
                'title' => $title,
                'description' => $description,
                'user_id' => $authUser->getKey(),
            ]);

        return Redirect::route('tasks.list');
    }

    public function delete(): RedirectResponse
    {
        $taskId = request()->input('task_id');

        Task::query()
            ->where('id', $taskId)
            ->delete();

        return Redirect::route('tasks.list');
    }
}
