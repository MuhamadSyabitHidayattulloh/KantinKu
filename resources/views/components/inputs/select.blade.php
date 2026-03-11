@props(['label' => '', 'placeholder' => 'Pilih opsi...', 'error' => '', 'required' => false, 'options' => []])

<div class="mb-4">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-600">*</span>
        @endif
    </label>
    @endif
    
    <select 
        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200 transition font-inter {{ $error ? 'border-red-500 focus:ring-red-200' : '' }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    
    @if($error)
    <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
    @endif
</div>
