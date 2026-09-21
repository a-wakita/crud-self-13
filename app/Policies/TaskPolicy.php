<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * タスク詳細を表示できるか
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * タスクを更新できるか
     */
    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('このタスクを編集する権限がありません。');
    }

    /**
     * タスクを削除できるか
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function before(User $user, string $ability): ?bool
    {
        // 管理者は全ての操作を許可
        if ($user->is_admin) {
            return true;
        }

        return null; // 通常の認可チェックを続行
    }

}