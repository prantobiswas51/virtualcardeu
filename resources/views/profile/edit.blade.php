<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-500 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class=" mx-auto space-y-6 ">

            {{-- Profile Photo Upload --}}
            <div class="p-4 sm:p-8 bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <div class="">
                    <form action="{{ route('upload_photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                        <label for="profile_photo" class="text-white">Profile Photo</label>
                
                        <!-- Image Preview -->
                        <div class="mb-4">
                            <img id="previewImage" 
                                 src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('default-avatar.png') }}" 
                                 class="block bg-gray-600 rounded-full w-[200px] h-[200px]">
                        </div>
                
                        <!-- File Input -->
                        <input type="file" id="profile_photo" name="profile_photo" class="mt-2 block text-white" onchange="previewFile()">
                
                        <!-- Save Button -->
                        <button type="submit" class="mt-4 bg-sky-600 p-1 px-4 rounded-md">SAVE</button>
                
                        @if(session('success'))
                            <span class="text-green-500">{{ session('success') }}</span>
                        @endif
                
                        @error('profile_photo') 
                            <span class="text-red-500">{{ $message }}</span> 
                        @enderror
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800 text-gray-200 shadow sm:rounded-lg">
                <div class=".">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class=".">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
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
