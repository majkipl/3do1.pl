<div class="field @isset($classWrapper){{ $classWrapper }}@endisset">
    <input type="text"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ $value }}"
           aria-label="{{ $placeholder }}{{ $required ? '*' : '' }}"
           placeholder="{{ $placeholder }}{{ $required ? '*' : '' }}"
           {{ $required ? 'required' : '' }}
           @if($max)
               maxlength="{{ $max }}"
           @endif
           @isset($class)
               class="{{ $class }}"
           @else
               class="input px--15"
           @endisset
           autocomplete="off"/>
    <span class="error-post error-{{ $name }}">{{ $error }}</span>
</div>
