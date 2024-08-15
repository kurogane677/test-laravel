<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($item) ? __('Update Item') : __('Create Item') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto mt-4">
    <form method="POST" action="{{ isset($item) ? route('items.update', $item->slug) : route('items.store') }}" enctype="multipart/form-data">
        @csrf

        @if (isset($item))
            @method('PUT')
        @endif
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $item->name ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $item->description ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <x-primary-button class="mt-3">
            {{ __('Submit') }}
        </x-primary-button>
    </form>
</div>
</x-app-layout>