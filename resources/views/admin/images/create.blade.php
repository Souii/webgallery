<x-app-layout title="New Image">
    <x-image.form
        :route="route('image.store')"
        action="create"
        :categories="$categories"
        :imageData="$data"
    />
</x-app-layout>
