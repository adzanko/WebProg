const quizData = [
    {
        question: "When faced with a challenging situation, how do you usually react?",
        options: [
            "I take charge and work on finding a solution immediately.",
            "I think creatively and try to find unique solutions.",
            "I try to help others and keep the peace in the group.",
            "I analyze the problem carefully before deciding on a solution."
        ],
        points: {
            a: { a: 1, b: 0, c: 0, d: 0, e: 0 },
            b: { a: 0, b: 1, c: 0, d: 0, e: 1 },
            c: { a: 0, b: 0, c: 1, d: 0, e: 0 },  
            d: { a: 0, b: 0, c: 0, d: 1, e: 0 }   
        }
    },
    {
        question: "How do you feel about trying new and unknown activities?",
        options: [
            "I love it! The thrill of new experiences excites me.",
            "I enjoy exploring new ideas but need time to think before diving in.",
            "I prefer activities that ensure harmony and avoid chaos.",
            "I prefer to stick with familiar activities that allow for deep focus and analysis"
        ],
        points: {
            a: { a: 1, b: 0, c: 0, d: 0, e: 1 },
            b: { a: 0, b: 1, c: 0, d: 0, e: 0 },
            c: { a: 0, b: 0, c: 1, d: 0, e: 0 },  
            d: { a: 0, b: 0, c: 0, d: 1, e: 0 }   
        }
    },
    {
        question: "How do you typically approach decision-making?",
        options: [
            "I trust my gut and make quick, confident decisions.",
            "I like to think outside the box and consider all possibilities.",
            "I try to consider everyone’s feelings and ensure no one is hurt by my decisions.",
            "I carefully evaluate all the details before making any decisions."
        ],
        points: {
            a: { a: 1, b: 0, c: 0, d: 0, e: 0 },
            b: { a: 0, b: 1, c: 0, d: 0, e: 1 },
            c: { a: 0, b: 0, c: 1, d: 0, e: 0 },  
            d: { a: 0, b: 0, c: 0, d: 1, e: 0 }   
        }
    },
    {
        question: "In a group setting, what role do you usually take?",
        options: [
            "I naturally take the lead and make decisions for the group.",
            "I bring new ideas to the table and encourage creative thinking.",
            "I ensure everyone feels supported and valued in the group.",
            "I prefer to observe and analyze the dynamics before contributing."
        ],
        points: {
            a: { a: 1, b: 0, c: 0, d: 0, e: 0 },
            b: { a: 0, b: 1, c: 0, d: 0, e: 0 },
            c: { a: 0, b: 0, c: 1, d: 0, e: 1 },  
            d: { a: 0, b: 0, c: 0, d: 1, e: 0 }   
        }
    },
    {
        question: "When interacting with others, how would you describe your personality?",
        options: [
            "Confident, outgoing, and always ready to take charge.",
            "Open-minded, imaginative, and eager to explore new ideas.",
            "Compassionate, nurturing, and always looking out for others.",
            "Logical, reserved, and deeply introspective."
        ],
        points: {
            a: { a: 1, b: 0, c: 0, d: 0, e: 1 },
            b: { a: 0, b: 1, c: 0, d: 0, e: 0 },
            c: { a: 0, b: 0, c: 1, d: 0, e: 0 },  
            d: { a: 0, b: 0, c: 0, d: 1, e: 0 }   
        }
    }
];

let currentQuestion = 0;
let scores = { a: 0, b: 0, c: 0, d: 0, e: 0 }; // Track scores for personality types

function initQuiz() {
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
        nextBtn.innerText = 'Next';

        if (question.givenAnswer !== undefined) {
            optionsEl.children[question.givenAnswer].classList.add('selected');
            nextBtn.style.display = 'block';
        }

        if (currentQuestion === 0) {
            quizFooter.classList.add('first-question-footer');
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
            quizFooter.classList.remove('first-question-footer');
        }

        if (currentQuestion === quizData.length - 1) {
            nextBtn.innerText = 'Finish quiz';
        }
        updateProgress();
    }

    function selectOption(selectedButton, optionIndex) {
        const buttons = optionsEl.getElementsByClassName('option');
        Array.from(buttons).forEach(button => button.classList.remove('selected'));
        
        selectedButton.classList.add('selected');
        quizData[currentQuestion].givenAnswer = optionIndex; // Store the answer
        nextBtn.style.display = 'block';
    }

    function saveAnswer() {
        const selectedOption = document.querySelector('button.option.selected');
        if (!selectedOption) return;
    
        const selectedAnswerIndex = Array.from(optionsEl.children).indexOf(selectedOption);
        quizData[currentQuestion].givenAnswer = selectedAnswerIndex;

        // ✅ Update the scores based on selected answer
        const points = quizData[currentQuestion].points;
        const selectedOptionKey = ['a', 'b', 'c', 'd'][selectedAnswerIndex];
        const selectedPoints = points[selectedOptionKey];

        for (let personality in selectedPoints) {
            scores[personality] += selectedPoints[personality];
        }
    }

    function updateProgress() {
        const progress = ((currentQuestion + 1) / quizData.length) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }

    function showResults() {
        let maxScore = Math.max(scores.a, scores.b, scores.c, scores.d, scores.e);
        let result = '';
        let imageUrl = '';

        if (maxScore === scores.a) {
            result = 'You are a Leader!';
           // imageUrl = 'images/leader.jpg';
        } else if (maxScore === scores.b) {
            result = 'You are Creative!';
           // imageUrl = 'images/creative.jpg';
        } else if (maxScore === scores.c) {
            result = 'You are a Caregiver!';
           // imageUrl = 'images/caregiver.jpg';
        } else if (maxScore === scores.d) {
            result = 'You are an Analyzer!';
           // imageUrl = 'images/analyzer.jpg';
        } else if (maxScore === scores.e) {
            result = 'You are an Adventurer!';
            //imageUrl = 'images/adventurer.jpg';
        }
{/* <div class="results">
                <div class="result-icon">
                    <img src="${imageUrl}" alt="${result}" class="result-image"><img src="${imageUrl}" alt="${result}" class="result-image">
                </div> */}
        quizContainer.innerHTML = `
            <div class="results">
                <div class="result-icon">
                    
                </div>
                <div class="score">${result}</div>
                <p>${result === 'You are a Leader!' ? 'You like to take charge!' :
                    result === 'You are Creative!' ? 'You think outside the box!' :
                    result === 'You are a Caregiver!' ? 'You care about others deeply!' :
                    result === 'You are an Analyzer!' ? 'You are thoughtful and analytical!' : 
                    'You thrive on new experiences!'}</p>
                <button class="btn btn-primary" onclick="restartQuiz()">Restart Quiz</button>
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
        if (currentQuestion >= 0) {
            loadQuestion();
        }
    });

    loadQuestion();
}

function restartQuiz() {
    scores = { a: 0, b: 0, c: 0, d: 0, e: 0 }; // Reset the scores
    currentQuestion = 0;
    quizData.forEach(q => delete q.givenAnswer); // Reset answers

    // Reload the quiz
    initQuiz();
}

// Automatically start the quiz when the page loads
document.addEventListener("DOMContentLoaded", () => {
    initQuiz();
});
