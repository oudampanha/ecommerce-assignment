<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600">
    {{ __('We\'ve sent a 6-digit verification code to your email address. Please enter the code below to verify your account.') }}
  </div>

  @if (session('message'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('message') }}
    </div>
  @endif

  @if ($errors->has('resend'))
    <div class="mb-4 font-medium text-sm text-red-600">
      {{ $errors->first('resend') }}
    </div>
  @endif

  <form method="POST" action="{{ route('verification.code.verify') }}">
    @csrf

    <div>
      <x-input-label for="verification_code" :value="__('Verification Code')" />
      <x-text-input id="verification_code" class="block mt-1 w-full text-center text-2xl tracking-widest" type="text"
        name="verification_code" :value="old('verification_code')" required autofocus maxlength="6" pattern="[0-9]{6}"
        placeholder="000000" />
      <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between mt-4">
      <x-primary-button>
        {{ __('Verify Code') }}
      </x-primary-button>
    </div>
  </form>

  <div class="mt-4 text-center">
    <form method="POST" action="{{ route('verification.code.resend') }}" class="inline">
      @csrf
      <button type="submit"
        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ __('Resend Verification Code') }}
      </button>
    </form>
  </div>

  <div class="mt-4 text-center">
    <form method="POST" action="{{ route('logout') }}" class="inline">
      @csrf
      <button type="submit"
        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ __('Log Out') }}
      </button>
    </form>
  </div>

  <script>
    // Auto-format verification code input
    document.getElementById('verification_code').addEventListener('input', function(e) {
      let value = e.target.value.replace(/[^0-9]/g, '');
      if (value.length > 6) value = value.slice(0, 6);
      e.target.value = value;

      // Auto-submit when 6 digits are entered
      if (value.length === 6) {
        e.target.form.submit();
      }
    });
  </script>
</x-guest-layout>
