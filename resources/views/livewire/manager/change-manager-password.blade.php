<div class="p-5">
    @if (session()->has('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="updatePassword" class="grid grid-cols-2 gap-2 mt-3">
        <div>
            <label>Enter Old Password</label>
            <input type="password" wire:model.defer="old_password"
                class="w-full border border-gray-300 rounded-md px-3 py-2">
            @error('old_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Enter New Password</label>
            <input type="password" wire:model.defer="new_password"
                class="w-full border border-gray-300 rounded-md px-3 py-2">
            @error('new_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-2 mt-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Password
            </button>
        </div>
    </form>
</div>