<div class="field file-uploads field-uploads @isset($class){{ $class }}@endisset">
    <div class="thumbs">
        <img src="{{ asset('images/svg/form/file.svg') }}" alt="thumbs" id="{{ $name }}_thumb"/>
    </div>
    <button type="button" class="info button-uploads">
        <img src="{{ $srcIcon }}" alt="cloud"/>
        <span>{{ $slot }}{{ $required ? '*' : '' }}</span>
    </button>
    <div class="uploads uploads-d-none">
        <input type="file"
               name="{{ $name }}"
               id="{{ $name }}"
               {{ $required ? 'required' : '' }}
               class="upload-image upload-file file"/>
    </div>
    <div class="error-post error-{{ $name }}">{{ $error }}</div>
</div>
