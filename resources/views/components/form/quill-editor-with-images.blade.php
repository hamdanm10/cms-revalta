@props([
    'name',
    'value'       => '',
    'placeholder' => 'Write something...',
    'uploadUrl',
])

<div
    x-data="quillEditorImages({ value: {{ json_encode(old($name, $value)) }}, placeholder: {{ json_encode($placeholder) }}, uploadUrl: {{ json_encode($uploadUrl) }} })"
    class="quill-wrapper {{ $errors->has($name) ? 'quill-error' : '' }}">

    <div x-ref="editor"></div>
    <input type="hidden" name="{{ $name }}" x-ref="input" />
</div>
