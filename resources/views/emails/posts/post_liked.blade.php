<x-mail::message>
    # Your post was liked

    {{ $liker->name }} liked one of your posts.

    <x-mail::button :url="$url">
        View post
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
