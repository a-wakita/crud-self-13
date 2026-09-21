//{{-- resources/views/components/task-form.blade.php --}}
@props(['task' => null, 'categories'])

//{{-- タイトル --}}
<div class="mb-4">
    <label for="title" class="block text-gray-700 font-medium mb-2">タイトル</label>
    <input type="text" name="title" id="title" value="{{ old('title', $task?->title) }}"
        class="w-full border border-gray-300 rounded px-3 py-2">
    @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

//{{-- 優先度 --}}
<div class="mb-4">
    <label for="priority" class="block text-gray-700 font-medium mb-2">優先度</label>
    <select name="priority" id="priority" class="w-full border border-gray-300 rounded px-3 py-2">
        <option value="1" {{ old('priority', $task?->priority) == 1 ? 'selected' : '' }}>低</option>
        <option value="2" {{ old('priority', $task?->priority) == 2 ? 'selected' : '' }}>中</option>
        <option value="3" {{ old('priority', $task?->priority) == 3 ? 'selected' : '' }}>高</option>
    </select>
</div>

//{{-- カテゴリー --}}
<div class="mb-4">
    <label for="category_id" class="block text-gray-700 font-medium mb-2">カテゴリー</label>
    <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-3 py-2">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $task?->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

//{{-- 説明 --}}
<div class="mb-6">
    <label for="description" class="block text-gray-700 font-medium mb-2">説明</label>
    <textarea name="description" id="description" rows="5"
        class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $task?->description) }}</textarea>
</div>

//{{-- 登録画面 --}}
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <x-task-form :categories="$categories" />
    <button type="submit">登録</button>
</form>

//{{-- 編集画面 --}}
<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')
    <x-task-form :task="$task" :categories="$categories" />
    <button type="submit">更新</button>
</form>

//{{-- ビュー --}}
<h3>カテゴリ別タスク数</h3>
<ul>
    @foreach ($categoryStats as $category => $count)
        <li>{{ $category }}: {{ $count }}件</li>
    @endforeach
</ul>