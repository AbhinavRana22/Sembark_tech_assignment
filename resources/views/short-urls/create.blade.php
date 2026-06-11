<x-app-layout>

<div class="container">
    <h1 class="mt-3" style="border: 2px solid #000; padding: 10px; border-radius: 5px;">Create Short URL</h3>
    <form method="POST" action="{{ route('short-urls.store') }}">
        @csrf
        <div class="mt-3">
            <label>
               Enter a URL to shorten
            </label>
            <input
                type="url"
                name="original_url"
                class="form-control"
                required>
        </div>
        <button class="btn btn-primary mt-3">Generate</button>
    </form>
</div>
</x-app-layout>