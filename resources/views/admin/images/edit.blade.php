<x-app-layout title="Edit Image">
    <x-image.form
        :route="route('image.update', $data['id'])"
        action="update"
        :categories="$categories"
        :imageData="$data"
    />
</x-app-layout>
