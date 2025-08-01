<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4 max-w-2xl mx-auto">
        <div class=" space-y-6 ">

            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class=".">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Profile Photo Upload --}}
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="">
                    <form action="{{ route('upload_photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                        <label for="profile_photo" class="">Profile Photo</label>
                
                        <!-- Image Preview -->
                        <div class="mb-4">
                            <img id="previewImage" 
                                 src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('default-avatar.png') }}" 
                                 class="block bg-gray-600 rounded-full w-[200px] h-[200px]">
                        </div>
                
                        <!-- File Input -->
                        <input type="file" id="profile_photo" name="profile_photo" class="mt-2 block " onchange="previewFile()">
                
                        <!-- Save Button -->
                        <x-primary-button type="submit" class="bg-sky-500 mt-4">{{ __('Save') }}</x-primary-button>
                
                        @if(session('success'))
                            <span class="text-green-500">{{ session('success') }}</span>
                        @endif
                
                        @error('profile_photo') 
                            <span class="text-red-500">{{ $message }}</span> 
                        @enderror
                    </form>
                </div>
            </div>

            {{-- Paypal email and pin update --}}
            <div class="p-4 sm:p-8   shadow sm:rounded-lg">
                <div class="" id="update_other_info">
                    <form action="{{ route('update_other_info') }}" method="POST">
                        @csrf
                
                        <label for="paypal_email" class=" text-sm">Paypal Email</label>
                        <input type="email" name="paypal_email" placeholder="Paypal Email" value="{{ Auth::user()->paypal_email }}" class="mb-2 block text-gray-700 w-full rounded-md">

                        <label for="" class=" text-sm">Mobile/Phone Number (Type with Country Code)</label>
                        <input type="number" name="mobile_number" placeholder="Number" value="{{ Auth::user()->number }}" class="mb-2 block text-gray-700 w-full rounded-md">

                        <label for="" class=" text-sm">
                            @if (Auth::user()->pin)
                                Current PIN
                            @else
                                Set PIN
                            @endif
                        </label>

                        <input type="number" name="pin" pattern="\d{6}" placeholder="Account Pin" class="mb-2 block text-gray-700 w-full rounded-md" required>

                        @if (Auth::user()->pin)
                            <label for="" class=" text-sm">New PIN</label>
                            <input type="number" name="new_pin" pattern="\d{6}" placeholder="Account Pin" class=" block text-gray-700 w-full rounded-md" required>
                        @endif

                        <!-- Save Button -->
                        {{-- <button  class="mt-4 bg-sky-600 p-1 px-4 rounded-md">SAVE</button> --}}
                        <x-primary-button type="submit" class="bg-sky-500 mt-4">{{ __('Save') }}</x-primary-button>

                    </form>
                    
                </div>
            </div>

            <div class="p-4 sm:p-8  shadow sm:rounded-lg">
                <div class=".">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8  shadow sm:rounded-lg">
                <div class=".">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const file = document.getElementById('profile_photo').files[0];
            const reader = new FileReader();
        
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            };
        
            if (file) {
                reader.readAsDataURL(file);
            }
        }
        </script>

</x-app-layout>
