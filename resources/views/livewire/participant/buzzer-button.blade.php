<div class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex flex-col">
    <!-- Header -->
    <div class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $competition->name }}</h1>
                    <p class="text-sm text-gray-600">{{ $participant?->display_name }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Skor</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $participant?->score ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex items-center justify-center p-4">
        <div class="max-w-2xl w-full space-y-8 text-center">
            
            <!-- Status Display -->
            <div class="bg-white rounded-xl p-6 shadow-2xl">
                @if($status === 'waiting')
                    <div class="text-gray-600">
                        <div class="text-6xl mb-4">⏳</div>
                        <h2 class="text-2xl font-bold mb-2">Menunggu Pertanyaan</h2>
                        <p>Host akan membuka pertanyaan sebentar lagi...</p>
                    </div>
                @elseif($status === 'ready')
                    <div class="text-green-600">
                        <div class="text-6xl mb-4">🚀</div>
                        <h2 class="text-2xl font-bold mb-4">Pertanyaan Terbuka!</h2>
                        @if($currentQuestion)
                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <p class="text-lg text-gray-800">{{ $currentQuestion }}</p>
                            </div>
                        @endif
                        <p>Tekan tombol BEL untuk menjawab!</p>
                    </div>
                @elseif($status === 'buzzed')
                    <div class="text-orange-600">
                        <div class="text-6xl mb-4">⚡</div>
                        <h2 class="text-2xl font-bold mb-2">Sudah Ada yang BEL!</h2>
                        @if($firstBuzzParticipant)
                            <p class="text-lg"><strong>{{ $firstBuzzParticipant }}</strong> yang pertama menekan BEL</p>
                        @endif
                    </div>
                @elseif($status === 'first')
                    <div class="text-blue-600">
                        <div class="text-6xl mb-4">🎯</div>
                        <h2 class="text-2xl font-bold mb-2">Anda yang Pertama!</h2>
                        <p>Tunggu host untuk menilai jawaban Anda</p>
                    </div>
                @endif
            </div>

            <!-- Buzzer Button -->
            <div class="flex justify-center">
                <button 
                    wire:click="buzz"
                    @disabled(!$canBuzz)
                    class="w-64 h-64 rounded-full text-6xl font-bold shadow-2xl transform transition-all duration-150 active:scale-95
                           {{ $canBuzz ? 'bg-red-500 hover:bg-red-600 text-white animate-pulse' : 'bg-gray-400 text-gray-600 cursor-not-allowed' }}"
                >
                    🔔
                </button>
            </div>

            @if($canBuzz)
                <p class="text-white text-xl font-semibold animate-bounce">
                    Tekan untuk BEL!
                </p>
            @endif

        </div>
    </div>

    <!-- Real-time updates -->
    <script>
        document.addEventListener('livewire:init', () => {
            if (window.Echo) {
                Echo.private('competition.{{ $competition->id }}')
                    .listen('.question-opened', (e) => {
                        Livewire.dispatch('question-opened', e);
                    })
                    .listen('.first-buzzed', (e) => {
                        Livewire.dispatch('first-buzzed', e);
                    })
                    .listen('.score-updated', (e) => {
                        Livewire.dispatch('score-updated', e);
                    });
            }
        });
    </script>
</div>
