<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600">
    <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-xl shadow-2xl">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                🧠 Cerdas Cermat
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Masukkan kode kompetisi untuk bergabung
            </p>
        </div>
        
        <form wire:submit="joinCompetition" class="mt-8 space-y-6">
            @if($error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ $error }}
                </div>
            @endif
            
            <div class="space-y-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">
                        Kode Kompetisi
                    </label>
                    <input wire:model="code" 
                           type="text" 
                           id="code" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm uppercase"
                           placeholder="ABC123"
                           required>
                    @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="displayName" class="block text-sm font-medium text-gray-700">
                        Nama Peserta
                    </label>
                    <input wire:model="displayName" 
                           type="text" 
                           id="displayName" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="Nama Anda"
                           required>
                    @error('displayName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50">
                <span wire:loading.remove>Bergabung</span>
                <span wire:loading>Memproses...</span>
            </button>
        </form>
    </div>
</div>
