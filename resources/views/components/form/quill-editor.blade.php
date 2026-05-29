@props([
    'name',
    'value'       => '',
    'placeholder' => 'Write something...',
])

<div
    x-data="quillEditor({ value: {{ json_encode(old($name, $value)) }}, placeholder: {{ json_encode($placeholder) }} })"
    class="quill-wrapper {{ $errors->has($name) ? 'quill-error' : '' }}">

    <div x-ref="editor"></div>
    <input type="hidden" name="{{ $name }}" x-ref="input" />
</div>
