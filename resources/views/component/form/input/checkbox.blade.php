<div class="field @isset($classWrapper){{ $classWrapper }}@endisset">
    <label for="{{ $name }}" class="label-checkbox @isset($class){{ $class }}@endisset">
        <input type="checkbox"
           name="{{ $name }}"
           id="{{ $name }}"
           class="input-checkbox checkbox p--0 m--0"
{{--        {{ $required ? 'required' : '' }} />--}}
        <span>{{ $required ? '*' : '' }}{{ $slot }}</span>
    </label>
    <span class="error-post error-{{ $name }}">{{ $error }}</span>
</div>
