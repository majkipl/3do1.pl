<div class="field @isset($classWrapper){{ $classWrapper }}@endisset">
    <textarea class="textarea p--15"
              name="{{ $name }}"
              id="{{ $name }}"
              {{ $required ? 'required' : '' }}
              @if($max)
                  maxlength="{{ $max }}"
              @endif
              autocomplete="off"
              aria-label="{{ $placeholder }}{{ $required ? '*' : '' }}"
              placeholder="{{ $placeholder }}{{ $required ? '*' : '' }}"
    >{{ $slot }}</textarea>
    <span class="error-post error-{{ $name }}">{{ $error }}</span>
</div>
