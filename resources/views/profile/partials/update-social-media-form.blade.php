<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Social Media Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's social links.") }}
        </p>
    </header>

    <form method="post" action="{{ route('social.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48"><path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"/><path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"/></svg>
                <x-input-label for="facebook" :value="__('Facebook')" />
            </div>
            <x-text-input id="facebook" name="facebook" type="url" class="mt-1 block w-full" :value="old('name', $user->social_media_account?->facebook)"
                autofocus autocomplete="name" placeholder="Your facebook"/>
            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
        </div>
        
        <div>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="#00acee" viewBox="0 0 25 23">
                    <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                </svg>
                <x-input-label for="twitter" :value="__('twitter')" />
            </div>
            <x-text-input id="twitter" name="twitter" type="url" class="mt-1 block w-full" :value="old('name', $user->social_media_account?->twitter)"
                autofocus autocomplete="name" placeholder="Your twitter"/>
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        </div>
        
        <div>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                <x-input-label for="google" :value="__('google')" />
            </div>
            <x-text-input id="google" name="google" type="url" class="mt-1 block w-full" :value="old('name', $user->social_media_account?->google)"
                autofocus autocomplete="name" placeholder="Your gmail"/>
            <x-input-error class="mt-2" :messages="$errors->get('google')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
