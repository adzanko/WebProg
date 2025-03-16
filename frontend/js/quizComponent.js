const quizData = [
    {
        question: "What is the capital of France?",
        options: ["London", "Berlin", "Paris", "Madrid"],
        correct: 2
    },
    {
        question: "Which planet is known as the Red Planet?",
        options: ["Venus", "Mars", "Jupiter", "Saturn"],
        correct: 1
    },
    {
        question: "Who painted the Mona Lisa?",
        options: ["Vincent van Gogh", "Pablo Picasso", "Leonardo da Vinci", "Michelangelo"],
        correct: 2
    },
    {
        question: "What is the largest ocean on Earth?",
        options: ["Atlantic Ocean", "Indian Ocean", "Arctic Ocean", "Pacific Ocean"],
        correct: 3
    },
    {
        question: "Which element has the chemical symbol 'O'?",
        options: ["Gold", "Silver", "Oxygen", "Iron"],
        correct: 2
    }
];

let currentQuestion = 0;
let score = 0;

const questionEl = document.getElementById('question');
const optionsEl = document.getElementById('options');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const progressBar = document.querySelector('.progress-bar');
const quizContainer = document.getElementById('quiz');
const quizFooter = document.querySelector('.quiz-footer');

function loadQuestion() {
    const question = quizData[currentQuestion];
    questionEl.textContent = question.question;
    optionsEl.innerHTML = '';
    question.options.forEach((option, index) => {
        const button = document.createElement('button');
        button.textContent = option;
        button.classList.add('option');
        button.addEventListener('click', () => selectOption(button, index));
        optionsEl.appendChild(button);
    });
    nextBtn.style.display = 'none';

    if (question.givenAnswer) {
        optionsEl.children[question.givenAnswer].classList.add('selected');
        nextBtn.style.display = 'block';
    }
    if (currentQuestion === 0 ) {
        quizFooter.classList.add('first-question-footer');
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'block';
        quizFooter.classList.remove('first-question-footer');
    }
    updateProgress();
}

function selectOption(selectedButton, optionIndex) {
    const buttons = optionsEl.getElementsByClassName('option');
    Array.from(buttons).forEach(button => button.classList.remove('selected'));
    selectedButton.classList.add('selected');
    nextBtn.style.display = 'block';
}

function saveAnswer() { 
    const selectedOption = document.querySelector('button.option.selected');
    if (!selectedOption) return;

    const selectedAnswerIndex = Array.from(optionsEl.children).indexOf(selectedOption);
    quizData[currentQuestion].givenAnswer = selectedAnswerIndex;

}

function updateProgress() {
    const progress = ((currentQuestion + 1) / quizData.length) * 100;
    progressBar.style.width = `${progress}%`;
    progressBar.setAttribute('aria-valuenow', progress);
}

function showResults() {
    quizContainer.innerHTML = `
                <div class="results">
                    <div class="result-icon">
                        <i class="fas ${score > quizData.length / 2 ? 'fa-trophy text-success' : 'fa-times-circle text-danger'}"></i>
                    </div>
                    <div class="score">Your score: ${score}/${quizData.length}</div>
                    <p>${score > quizData.length / 2 ? 'Great job!' : 'Better luck next time!'}</p>
                    <button class="btn btn-primary" onclick="location.reload()">Restart Quiz</button>
                </div>
            `;
}

nextBtn.addEventListener('click', () => {
    saveAnswer();
    currentQuestion++;
    if (currentQuestion < quizData.length) {
        loadQuestion();
    } else {
        showResults();
    }
});

prevBtn.addEventListener('click', () => {
    currentQuestion--;
    if (currentQuestion < quizData.length) {
        loadQuestion();
    }
});

loadQuestion();