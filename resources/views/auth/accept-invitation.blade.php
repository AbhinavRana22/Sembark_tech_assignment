<x-guest-layout>

    <form method="POST"
          action="{{ route('invitation.register') }}">

        @csrf

        <div class="mt-4">

            <x-input-label
                for="email"
                value="Email" />

            <x-text-input
                type="text"
                name="email"
                class="block mt-1 w-full"
                value="{{ $user->email }}"
                readonly />
               
            <x-input-label
                for="name"
                value="Name" />

            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                required />

        </div>

        <div class="mt-4">

            <x-input-label
                for="password"
                value="Password" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required />

        </div>

        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                value="Confirm Password" />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />

        </div>

        <div class="mt-4">

            <x-primary-button>
                Activate Account
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>