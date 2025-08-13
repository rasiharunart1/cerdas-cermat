/**
 * script.js - Aplikasi Cerdas Cermat
 */

// Data pertanyaan berdasarkan kategori
const questionData = {
    umum: [
        {
            question: "Siapa presiden pertama Indonesia?",
            answers: ["Soekarno", "Soeharto", "Habibie", "Megawati"],
            correct: 0
        },
        {
            question: "Apa ibukota Australia?",
            answers: ["Sydney", "Melbourne", "Canberra", "Brisbane"],
            correct: 2
        },
        {
            question: "Berapa jumlah benua di dunia?",
            answers: ["5", "6", "7", "8"],
            correct: 2
        },
        {
            question: "Siapa penemu telepon?",
            answers: ["Thomas Edison", "Alexander Graham Bell", "Nikola Tesla", "Albert Einstein"],
            correct: 1
        },
        {
            question: "Apa mata uang Jepang?",
            answers: ["Won", "Yuan", "Yen", "Ringgit"],
            correct: 2
        },
        {
            question: "Planet terbesar di tata surya adalah?",
            answers: ["Saturnus", "Jupiter", "Neptunus", "Uranus"],
            correct: 1
        },
        {
            question: "Berapa jumlah provinsi di Indonesia saat ini?",
            answers: ["34", "35", "36", "37"],
            correct: 0
        },
        {
            question: "Siapa penulis novel 'Laskar Pelangi'?",
            answers: ["Andrea Hirata", "Habiburrahman El Shirazy", "Dee Lestari", "Tere Liye"],
            correct: 0
        },
        {
            question: "Apa nama laut yang memisahkan Eropa dan Afrika?",
            answers: ["Laut Hitam", "Laut Kaspia", "Laut Mediterania", "Laut Merah"],
            correct: 2
        },
        {
            question: "Berapa lama waktu rotasi bumi?",
            answers: ["23 jam 56 menit", "24 jam", "24 jam 4 menit", "25 jam"],
            correct: 0
        }
    ],
    sejarah: [
        {
            question: "Kapan Indonesia merdeka?",
            answers: ["17 Agustus 1945", "17 Agustus 1944", "18 Agustus 1945", "16 Agustus 1945"],
            correct: 0
        },
        {
            question: "Siapa yang memimpin Perang Diponegoro?",
            answers: ["Pangeran Diponegoro", "Sultan Agung", "Imam Bonjol", "Pattimura"],
            correct: 0
        },
        {
            question: "Kapan Perang Dunia II berakhir?",
            answers: ["1944", "1945", "1946", "1947"],
            correct: 1
        },
        {
            question: "Siapa raja Majapahit yang terkenal?",
            answers: ["Gajah Mada", "Hayam Wuruk", "Ken Arok", "Raden Wijaya"],
            correct: 1
        },
        {
            question: "Kapan VOC didirikan?",
            answers: ["1600", "1602", "1605", "1610"],
            correct: 1
        },
        {
            question: "Siapa yang memimpin ekspedisi ke Maluku?",
            answers: ["Vasco da Gama", "Christopher Columbus", "Ferdinand Magellan", "Amerigo Vespucci"],
            correct: 2
        },
        {
            question: "Kapan Kerajaan Sriwijaya mencapai puncak kejayaan?",
            answers: ["Abad ke-7", "Abad ke-8", "Abad ke-9", "Abad ke-10"],
            correct: 0
        },
        {
            question: "Siapa pemimpin Perang Padri?",
            answers: ["Tuanku Imam Bonjol", "Cut Nyak Dien", "Sultan Hasanuddin", "Teuku Umar"],
            correct: 0
        },
        {
            question: "Kapan Dekrit Presiden 5 Juli dikeluarkan?",
            answers: ["1958", "1959", "1960", "1961"],
            correct: 1
        },
        {
            question: "Siapa arsitek Monas?",
            answers: ["Frederich Silaban", "R.M. Soedarsono", "Soekarno", "Sukarno dan tim"],
            correct: 0
        }
    ],
    geografi: [
        {
            question: "Gunung tertinggi di Indonesia adalah?",
            answers: ["Gunung Kerinci", "Puncak Jaya", "Gunung Semeru", "Gunung Rinjani"],
            correct: 1
        },
        {
            question: "Selat yang memisahkan Jawa dan Sumatera adalah?",
            answers: ["Selat Malaka", "Selat Sunda", "Selat Lombok", "Selat Bali"],
            correct: 1
        },
        {
            question: "Danau terbesar di Indonesia adalah?",
            answers: ["Danau Toba", "Danau Singkarak", "Danau Maninjau", "Danau Sentarum"],
            correct: 0
        },
        {
            question: "Pulau terbesar di dunia adalah?",
            answers: ["Kalimantan", "New Guinea", "Greenland", "Madagascar"],
            correct: 2
        },
        {
            question: "Sungai terpanjang di dunia adalah?",
            answers: ["Sungai Amazon", "Sungai Nil", "Sungai Yangtze", "Sungai Mississippi"],
            correct: 1
        },
        {
            question: "Negara dengan jumlah penduduk terbanyak adalah?",
            answers: ["India", "China", "Amerika Serikat", "Indonesia"],
            correct: 1
        },
        {
            question: "Gurun terluas di dunia adalah?",
            answers: ["Gurun Sahara", "Gurun Gobi", "Gurun Kalahari", "Gurun Atacama"],
            correct: 0
        },
        {
            question: "Garis khatulistiwa melewati berapa negara?",
            answers: ["11", "12", "13", "14"],
            correct: 2
        },
        {
            question: "Samudra terluas di dunia adalah?",
            answers: ["Samudra Atlantik", "Samudra Hindia", "Samudra Pasifik", "Samudra Arktik"],
            correct: 2
        },
        {
            question: "Titik terdalam di bumi adalah?",
            answers: ["Palung Mariana", "Palung Puerto Rico", "Palung Jepang", "Palung Peru"],
            correct: 0
        }
    ],
    sains: [
        {
            question: "Rumus kimia air adalah?",
            answers: ["H2O", "CO2", "NaCl", "CH4"],
            correct: 0
        },
        {
            question: "Kecepatan cahaya dalam vakum adalah?",
            answers: ["300.000 km/s", "299.792.458 m/s", "150.000 km/s", "500.000 km/s"],
            correct: 1
        },
        {
            question: "Organ manusia yang memproduksi insulin adalah?",
            answers: ["Hati", "Ginjal", "Pankreas", "Limpa"],
            correct: 2
        },
        {
            question: "Gas yang paling banyak di atmosfer bumi adalah?",
            answers: ["Oksigen", "Nitrogen", "Karbon dioksida", "Argon"],
            correct: 1
        },
        {
            question: "Satuan SI untuk gaya adalah?",
            answers: ["Joule", "Newton", "Watt", "Pascal"],
            correct: 1
        },
        {
            question: "DNA singkatan dari?",
            answers: ["Deoxyribonucleic Acid", "Dinitro Acid", "Double Nuclear Acid", "Dynamic Nuclear Acid"],
            correct: 0
        },
        {
            question: "Berapa jumlah kromosom manusia normal?",
            answers: ["44", "45", "46", "47"],
            correct: 2
        },
        {
            question: "Proses fotosintesis membutuhkan?",
            answers: ["CO2 dan H2O", "O2 dan H2O", "CO2 dan O2", "N2 dan H2O"],
            correct: 0
        },
        {
            question: "Suhu 0°C sama dengan berapa Kelvin?",
            answers: ["273 K", "273.15 K", "100 K", "373 K"],
            correct: 1
        },
        {
            question: "Unsur kimia dengan simbol Au adalah?",
            answers: ["Perak", "Emas", "Aluminium", "Argon"],
            correct: 1
        }
    ],
    matematika: [
        {
            question: "Berapa hasil dari 15 × 8?",
            answers: ["110", "115", "120", "125"],
            correct: 2
        },
        {
            question: "Nilai π (pi) kira-kira adalah?",
            answers: ["3.14159", "3.15159", "3.14259", "3.13159"],
            correct: 0
        },
        {
            question: "Akar kuadrat dari 144 adalah?",
            answers: ["11", "12", "13", "14"],
            correct: 1
        },
        {
            question: "Berapa derajat sudut dalam segitiga?",
            answers: ["90°", "180°", "270°", "360°"],
            correct: 1
        },
        {
            question: "Hasil dari 2³ adalah?",
            answers: ["6", "8", "9", "12"],
            correct: 1
        },
        {
            question: "Rumus luas lingkaran adalah?",
            answers: ["πr²", "2πr", "πd", "4πr"],
            correct: 0
        },
        {
            question: "Berapa persen dari 50 adalah 15?",
            answers: ["25%", "30%", "35%", "40%"],
            correct: 1
        },
        {
            question: "Nilai dari sin 90° adalah?",
            answers: ["0", "0.5", "1", "√3/2"],
            correct: 2
        },
        {
            question: "Logaritma dari 100 basis 10 adalah?",
            answers: ["1", "2", "10", "100"],
            correct: 1
        },
        {
            question: "Deret Fibonacci dimulai dengan angka?",
            answers: ["0, 1", "1, 1", "1, 2", "0, 2"],
            correct: 0
        }
    ]
};

// Variabel global
let currentQuestions = [];
let currentQuestionIndex = 0;
let score = 0;
let timeLeft = 30;
let timer;
let selectedCategory = ''; 

// Elemen DOM
const categoriesSection = document.getElementById('categories');
const gameArea = document.querySelector('.game-area');
const questionText = document.getElementById('question-text');
const answersContainer = document.getElementById('answers-container');
const scoreElement = document.getElementById('score');
const questionCounter = document.getElementById('question-counter');
const timerElement = document.getElementById('timer');
const progressBar = document.getElementById('progress');
const nextBtn = document.getElementById('next-btn');
const restartBtn = document.getElementById('restart-btn');
const resultSection = document.getElementById('result-section');
const finalScore = document.getElementById('final-score');
const performanceMessage = document.getElementById('performance-message');
const playAgainBtn = document.getElementById('play-again-btn');

// Event listeners
document.addEventListener('DOMContentLoaded', initializeApp);

function initializeApp() {
    showCategories();
    setupEventListeners();
}

function setupEventListeners() {
    // Category buttons
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            selectedCategory = e.target.dataset.category;
            startQuiz();
        });
    });

    // Control buttons
    nextBtn.addEventListener('click', nextQuestion);
    restartBtn.addEventListener('click', showCategories);
    playAgainBtn.addEventListener('click', showCategories);
}

function showCategories() {
    categoriesSection.style.display = 'block';
    gameArea.style.display = 'none';
    resultSection.style.display = 'none';
    resetGame();
}

function startQuiz() {
    categoriesSection.style.display = 'none';
    gameArea.style.display = 'block';
    resultSection.style.display = 'none';
    
    currentQuestions = [...questionData[selectedCategory]];
    shuffleArray(currentQuestions);
    currentQuestions = currentQuestions.slice(0, 10); // Ambil 10 pertanyaan
    
    resetGame();
    loadQuestion();
    startTimer();
}

function resetGame() {
    currentQuestionIndex = 0;
    score = 0;
    timeLeft = 30;
    updateDisplay();
    clearInterval(timer);
}

function loadQuestion() {
    if (currentQuestionIndex >= currentQuestions.length) {
        endQuiz();
        return;
    }

    const question = currentQuestions[currentQuestionIndex];
    questionText.textContent = question.question;
    
    answersContainer.innerHTML = '';
    
    question.answers.forEach((answer, index) => {
        const button = document.createElement('button');
        button.className = 'btn answer-btn';
        button.textContent = answer;
        button.addEventListener('click', () => selectAnswer(index));
        answersContainer.appendChild(button);
    });

    updateDisplay();
    resetTimer();
}

function selectAnswer(selectedIndex) {
    clearInterval(timer);
    
    const question = currentQuestions[currentQuestionIndex];
    const buttons = document.querySelectorAll('.answer-btn');
    
    buttons.forEach((btn, index) => {
        btn.disabled = true;
        if (index === question.correct) {
            btn.style.backgroundColor = '#4CAF50';
        } else if (index === selectedIndex && index !== question.correct) {
            btn.style.backgroundColor = '#f44336';
        }
    });

    if (selectedIndex === question.correct) {
        score++;
    }

    nextBtn.style.display = 'inline-block';
    updateDisplay();
}

function nextQuestion() {
    currentQuestionIndex++;
    nextBtn.style.display = 'none';
    
    if (currentQuestionIndex < currentQuestions.length) {
        loadQuestion();
        startTimer();
    } else {
        endQuiz();
    }
}

function startTimer() {
    timeLeft = 30;
    updateTimer();
    
    timer = setInterval(() => {
        timeLeft--;
        updateTimer();
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            selectAnswer(-1); // Waktu habis, anggap salah
        }
    }, 1000);
}

function resetTimer() {
    clearInterval(timer);
    timeLeft = 30;
    updateTimer();
}

function updateTimer() {
    timerElement.textContent = timeLeft;
    timerElement.style.color = timeLeft <= 10 ? '#f44336' : '#333';
}

function updateDisplay() {
    scoreElement.textContent = score;
    questionCounter.textContent = `${currentQuestionIndex + 1}/10`;
    
    const progress = ((currentQuestionIndex) / 10) * 100;
    progressBar.style.width = progress + '%';
}

function endQuiz() {
    gameArea.style.display = 'none';
    resultSection.style.display = 'block';
    
    finalScore.textContent = `${score}/10`;
    
    let message = '';
    if (score >= 9) {
        message = '🏆 Excellent! Anda sangat hebat!';
    } else if (score >= 7) {
        message = '👏 Very Good! Pengetahuan Anda luas!';
    } else if (score >= 5) {
        message = '👍 Good! Terus belajar ya!';
    } else {
        message = '📚 Keep Learning! Jangan menyerah!';
    }
    
    performanceMessage.textContent = message;
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}