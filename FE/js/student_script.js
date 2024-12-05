// Variables for timer and questions
let timeLeft = 0;
let questions = [];

// Fetch test data from the backend
const testId = new URLSearchParams(window.location.search).get("testId"); // Get testId from URL
fetch(`include/getTestData.php?testId=${testId}`)
    .then((response) => response.json())
    .then((data) => {
        if (data.error) {
            alert("Error fetching test data: " + data.error);
            return;
        }

        // Initialize timeLeft and questions
        timeLeft = parseInt(data.timeLeft); // Ensure timeLeft is a number
        questions = data.questions;

        // Start the timer
        updateTimer();

        // Populate questions on the page
        populateQuestions(questions);
    })
    .catch((error) => {
        console.error("Error:", error);
        alert("Failed to fetch test data.");
    });

// Function to populate questions on the page
function populateQuestions(questions) {
    const questionsList = document.getElementById("questionsList");

    questions.forEach((question, index) => {
        const questionHtml = `
            <div class="question-item">
                <h5>Question ${index + 1}: ${question.text}</h5>
                ${question.image ? `<img src="${question.image}" alt="Question Image" class="image-preview">` : ""}
                <div>
                    ${question.options
                        .map(
                            (option, i) => `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question-${question.id}" id="question-${question.id}-option-${i}" value="${option}">
                                <label class="form-check-label" for="question-${question.id}-option-${i}">
                                    ${option}
                                </label>
                            </div>
                        `
                        )
                        .join("")}
                </div>
            </div>
        `;
        questionsList.insertAdjacentHTML("beforeend", questionHtml);
    });
}

// Timer logic
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${minutes.toString().padStart(2, "0")}:${remainingSeconds.toString().padStart(2, "0")}`;
}

function updateTimer() {
    const timerElement = document.getElementById("timer");
    timerElement.textContent = formatTime(timeLeft);

    if (timeLeft > 0) {
        timeLeft--;
    } else {
        clearInterval(timerInterval);
        alert("Time's up!");
    }
}

// Start the countdown timer
let timerInterval = setInterval(updateTimer, 1000);
