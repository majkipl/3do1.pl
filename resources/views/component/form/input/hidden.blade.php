<div class="field @isset($classWrapper){{ $classWrapper }}@endisset">
    <input type="hidden"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ $value }}"
           @isset($class)
               class="{{ $class }}"
           @else
               class="input"
           @endisset
    />
</div>
<span class="error-post error-{{ $name }}">{{ $error }}</span>
