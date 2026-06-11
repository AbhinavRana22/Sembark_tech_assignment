<x-app-layout>

<div class="container">

     <h1 class="mt-3" style="border: 2px solid #000; padding: 10px; border-radius: 5px;">Invite User</h3>

    <form method="POST"
          action="{{ route('invite-user.store') }}">

        @csrf
            <div class="mt-3">
                <label>Company</label>
                <select name="company_id" class="form-control mb-2">
                    <option value="">
                        Select Company
                    </option>
                    @if($companies->count() > 0)
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">
                                {{ $company->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

        @role('Admin')
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    @if(isset($roles) && $roles->count() > 0)
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        @endrole

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" required class="form-control">
        </div>

        <button class="btn btn-primary">
            Send Invitation
        </button>
    </form>
</div>
</x-app-layout>