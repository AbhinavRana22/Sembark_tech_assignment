<x-app-layout>

<div class="container">
<div class ="col-md-12">
    <h1 class="mt-3" style="border: 2px solid #000; padding: 10px; border-radius: 5px;">Create Company and Send Invitation</h1>
<form action="{{ route('companies.store') }}" method="POST">
    @csrf
    <div class="form-group col-md-6 mt-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group col-md-6 mt-3">
        <label for="email">Admin Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Send Invitation</button>
</form>
</div>
</div>

</x-app-layout>