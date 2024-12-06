const questionsList = document.getElementById("questionsList");
const overviewList = document.getElementById("overviewList");

// Add Question Functionality
document.getElementById("addQuestionBtn").addEventListener("click", function () {
    const questionId = new Date().getTime(); // Unique ID for each question
    const questionItemHtml = `
    <div class="question-item" data-id="${questionId}">
        <label for="question-${questionId}">Question:</label>
        <input type="text" id="question-${questionId}" class="form-control question-input" placeholder="Enter your question">
        <input type="file" class="form-control" id="questionImage-${questionId}" accept="image/png, image/jpeg">
        <img id="previewImage-${questionId}" class="image-preview" alt="Image Preview">
        <div class="options">
            <label>A:</label>
            <input type="text" class="form-control option-input" data-option="A" value="Option A">
            <label>B:</label>
            <input type="text" class="form-control option-input" data-option="B" value="Option B">
            <label>C:</label>
            <input type="text" class="form-control option-input" data-option="C" value="Option C">
            <label>D:</label>
            <input type="text" class="form-control option-input" data-option="D" value="Option D">
        </div>
        <div class="correct-answer">
            <label for="correct-answer-${questionId}">Correct Answer:</label>
            <select id="correct-answer-${questionId}" class="form-control">
                <option value="A">Option A</option>
                <option value="B">Option B</option>
                <option value="C">Option C</option>
                <option value="D">Option D</option>
            </select>
        </div>
    </div>
    `;

    questionsList.insertAdjacentHTML("beforeend", questionItemHtml);

    // Handle image preview
    const fileInput = document.getElementById(`questionImage-${questionId}`);
    const previewImage = document.getElementById(`previewImage-${questionId}`);

    fileInput.addEventListener("change", function () {
        const file = this.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader(); // Create a FileReader to read the file
            reader.onload = function (e) {
                previewImage.src = e.target.result; // Set the image source to the file content
                previewImage.style.display = "block"; // Show the preview image
            };
            reader.readAsDataURL(file); // Read the file as a Data URL
        } else {
            previewImage.style.display = "none"; // Hide the image if no file is selected
        }
    });

    updateOverview(); // Update the overview when a question is added
});

// Function to update the overview
function updateOverview() {
    overviewList.innerHTML = ""; // Clear existing overview

    // Get all questions
    const questionItems = document.querySelectorAll(".question-item");
    questionItems.forEach((questionItem, index) => {
        const questionText = questionItem.querySelector(".question-input").value || `Question ${index + 1}`;
        const options = questionItem.querySelectorAll(".option-input");
        const correctAnswer = questionItem.querySelector(".correct-answer select").value;

        let optionsHtml = "";
        options.forEach((option) => {
            const optionValue = option.dataset.option;
            const optionText = option.value;
            optionsHtml += `<li>${optionValue}: ${optionText}</li>`;
        });

        const overviewHtml = `
        <div class="overview-item">
            <h5>${index + 1}. ${questionText}</h5>
            <ul>${optionsHtml}</ul>
            <p><strong>Correct Answer:</strong> ${correctAnswer}</p>
        </div>
        `;
        overviewList.insertAdjacentHTML("beforeend", overviewHtml);
    });
}

// Event delegation to detect changes in question text or options and update the overview
questionsList.addEventListener("input", function (event) {
    if (event.target.classList.contains("question-input") || event.target.classList.contains("option-input")) {
        updateOverview(); // Update the overview whenever inputs change
    }
});

questionsList.addEventListener("change", function (event) {
    if (event.target.tagName === "SELECT") {
        updateOverview(); // Update the overview whenever the correct answer changes
    }
});
