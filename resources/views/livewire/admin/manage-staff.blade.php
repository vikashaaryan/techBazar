<div class="max-w-4lg mx-auto bg-white dark:bg-gray-900 p-8 rounded-lg shadow-lg">
    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-100">Add Staff</h2>
    <form class="space-y-6" wire:click.prevent="addStaff">
        <!-- Name, Email, Contact -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" wire:model.live="name" value="{{ old('name') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg  bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" wire:model.live="email" value="{{ old('email') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('email') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact</label>
                <input type="text" wire:model.live="contact" value="{{ old('contact') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('contact') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Role, Salary, Join Date -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                <select wire:model.live="role"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    <option value="admin">admin</option>
                    <option value="staff" selected>staff</option>
                </select>
                @error('role') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror

            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salary</label>
                <input type="number" wire:model.live="salary" step="0.01" value="{{ old('salary') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('salary') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror

            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Join Date</label>
                <input type="date" wire:model.live="join_date"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('join_date') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Address -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                <textarea wire:model.live="address" rows="2"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">{{ old('address') }}</textarea>
                @error('address') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                    <input type="text" wire:model.live="city"
                        class="mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    @error('city') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                    <input type="text" wire:model.live="state"
                        class="mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    @error('state') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pincode</label>
                    <input type="text" wire:model.live="pincode"
                        class="mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    @error('pincode') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Password & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" wire:model.live="password"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                @error('password') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select wire:model.live="status"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Add
                Staff</button>
        </div>
    </form>
</div>