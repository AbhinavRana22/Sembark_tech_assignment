<x-app-layout>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('companies.create') }}"
       class="btn btn-primary m-3">
        Add Company
    </a>
    <h1 class="mb-3" style="border: 2px solid #000; padding: 10px; border-radius: 5px;">Companies List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Total Users</th>
            </tr>
        </thead>
        <tbody>
    
    @if(isset($companies) && $companies->count() > 0)
        @foreach($companies as $key=>$company)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->users()->count() }}</td>
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