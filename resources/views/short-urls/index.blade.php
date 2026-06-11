<x-app-layout>
<div class="container">

      @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    @unless(auth()->user()->hasRole('Super Admin'))
        <a href="{{ route('short-urls.create') }}" class="btn btn-primary m-3">Create URL</a>
    @endunless
            <h1 class="mb-3" style="border: 2px solid #000; padding: 10px; border-radius: 5px;">Generated Short URLs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Clicks</th>
                <th>Company Name</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
        @if(isset($shortUrls) && $shortUrls->count() > 0)
            @foreach($shortUrls as $key=>$url)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $url->original_url }}</td>
                    <td>
                    <a href="{{ url('/s/'.$url->short_code) }}" target="_blank" style="color: #1689dd; text-decoration: underline; font-weight: bold;">{{ url('/s/'.$url->short_code) }}</a>
                    </td>
                    <td>{{ $url->clicks }}</td>
                    <td>{{ $url->company->name }}</td>
                    <td>{{ $url->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
</x-app-layout>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
    });
</script>