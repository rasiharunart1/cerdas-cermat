<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Panel Host - {{ $competition->name }}</h1>
            <p class="text-gray-600">Kode: <strong>{{ $competition->code }}</strong> | Status: 
                <span class="px-2 py-1 rounded text-xs font-semibold
                    {{ $competition->status === 'running' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($competition->status) }}
                </span>
            </p>
        </div>

        @if(session('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Competition Control -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Status Control -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-medium mb-4">Kontrol Kompetisi</h2>
                    <div class="flex space-x-2">
                        <button wire:click="updateStatus('ready')" 
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Ready
                        </button>
                        <button wire:click="updateStatus('running')" 
                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Running
                        </button>
                        <button wire:click="updateStatus('finished')" 
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Finished
                        </button>
                    </div>
                </div>

                <!-- Question Control -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-medium mb-4">Kontrol Pertanyaan</h2>
                    
                    @if($currentQuestion)
                        <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                            <h3 class="font-semibold">Pertanyaan Aktif:</h3>
                            <p class="text-gray-700">{{ $currentQuestion['text'] }}</p>
                            <div class="mt-2 text-sm text-gray-600">
                                Type: {{ $currentQuestion['type'] }} | Points: {{ $currentQuestion['points'] }}
                            </div>
                        </div>

                        @if($firstBuzzParticipant)
                            <div class="mb-4 p-4 bg-yellow-50 rounded-lg">
                                <h4 class="font-semibold text-yellow-800">First Buzz:</h4>
                                <p class="text-yellow-700">{{ $firstBuzzParticipant }}</p>
                                <div class="mt-2 space-x-2">
                                    <button wire:click="markCorrect" 
                                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        ✓ Benar
                                    </button>
                                    <button wire:click="markWrong" 
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        ✗ Salah
                                    </button>
                                </div>
                            </div>
                        @endif

                        <button wire:click="nextQuestion" 
                                class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                            Pertanyaan Selanjutnya
                        </button>
                    @else
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Pertanyaan
                                </label>
                                <select wire:model="selectedQuestionId" 
                                        class="w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">-- Pilih Pertanyaan --</option>
                                    @foreach($questions as $question)
                                        <option value="{{ $question->id }}">
                                            Q{{ $question->pivot->order }}: {{ Str::limit($question->text, 50) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button wire:click="openQuestion" 
                                    @disabled(!$selectedQuestionId)
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:bg-gray-400">
                                Buka Pertanyaan
                            </button>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right Column: Leaderboard -->
            <div class="space-y-6">
                
                <!-- Leaderboard -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-medium mb-4">Leaderboard</h2>
                    
                    @if(count($participants) > 0)
                        <div class="space-y-2">
                            @foreach($participants as $index => $participant)
                                <div class="flex justify-between items-center p-3 {{ $index === 0 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50' }} rounded">
                                    <div class="flex items-center">
                                        <span class="w-6 h-6 rounded-full bg-indigo-500 text-white text-xs flex items-center justify-center mr-3">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="font-medium">{{ $participant['display_name'] }}</span>
                                    </div>
                                    <span class="font-bold text-lg">{{ $participant['score'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center">Belum ada peserta</p>
                    @endif
                </div>

                <!-- Competition Info -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium mb-4">Info Kompetisi</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Total Peserta:</span>
                            <span class="font-semibold">{{ count($participants) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Pertanyaan:</span>
                            <span class="font-semibold">{{ $questions->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Status:</span>
                            <span class="font-semibold">{{ ucfirst($competition->status) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Real-time updates -->
    <script>
        document.addEventListener('livewire:init', () => {
            if (window.Echo) {
                Echo.private('competition.{{ $competition->id }}')
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
