// app/Http/Requests/StoreTaskRequest.php
class StoreTaskRequest extends FormRequest
{
public function authorize(): bool
{
return true;
}

public function rules(): array
{
return [
'title' => 'required|max:255',
'description' => 'nullable',
'priority' => 'required|integer|in:1,2,3',
'category_id' => 'required|exists:categories,id',
];
}

public function messages(): array
{
return [
'title.required' => 'タイトルは必須です。',
'priority.required' => '優先度は必須です。',
'priority.in' => '優先度は1〜3の値を選択してください。',
'category_id.required' => 'カテゴリーは必須です。',
'category_id.exists' => '選択されたカテゴリーは存在しません。',
];
}
}