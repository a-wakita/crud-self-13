// app/Policies/TaskPolicy.php
class TaskPolicy
{
/**
* タスクの詳細表示・編集・削除の認可
*/
public function view(User $user, Task $task): bool
{
return $user->id === $task->user_id;
}

public function update(User $user, Task $task): bool
{
return $user->id === $task->user_id;
}

public function delete(User $user, Task $task): bool
{
return $user->id === $task->user_id;
}
}