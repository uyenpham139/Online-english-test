const questionsList = document.getElementById("questionsList");

// Add Question Functionality
document.getElementById("addQuestionBtn").addEventListener("click", function () {
    const questionId = new Date().getTime(); // Unique ID for each question
    const questionItemHtml = `
    <form method="POST" action="include/test.inc.php">
        <div class="question-item" data-id="${questionId}">
            <label for="question-${questionId}">Question:</label>
            <input type="text" id="question-${questionId}" name="question" class="form-control" placeholder="Enter your question">
            <input type="file" class="form-control" id="questionImage" name="picture" accept="image/png, image/jpeg">
            <img id="previewImage" class="image-preview" alt="Image Preview">
            <div class="options">
                <label>A:</label>
                <input type="text" name="answer_1" class="form-control" value="Option A">
                <label>B:</label>
                <input type="text" name="answer_2" class="form-control" value="Option B">
                <label>C:</label>
                <input type="text" name="answer_3" class="form-control" value="Option C">
                <label>D:</label>
                <input type="text" name="answer_4" class="form-control" value="Option D">
            </div>
            <div class="correct-answer">
                <label for="correct-answer-${questionId}">Correct Answer:</label>
                <select id="correct-answer-${questionId}" name="correct_answer" class="form-control">
                    <option value="Option A">Option A</option>
                    <option value="Option B">Option B</option>
                    <option value="Option C">Option C</option>
                    <option value="Option D">Option D</option>
                </select>
            </div>
            <div class="question-actions">
                <button type="submit" name="submit_exam_questions" class="btn btn-warning btn-sm update-btn">Update</button>
                <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
            </div>
        </div>
    </form>
    `;

    questionsList.insertAdjacentHTML("beforeend", questionItemHtml);
    const fileInput = document.getElementById('questionImage');
    const previewImage = document.getElementById('previewImage');

    fileInput.addEventListener('change', function () {
        const file = this.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader(); // Create a FileReader to read the file
            reader.onload = function (e) {
                previewImage.src = e.target.result; // Set the image source to the file content
                previewImage.style.display = 'block'; // Show the preview image
            }
            reader.readAsDataURL(file); // Read the file as a Data URL
        } else {
            previewImage.style.display = 'none'; // Hide the image if no file is selected
        }
    });

    
});

// Event delegation for Update and Delete buttons
questionsList.addEventListener("click", function (event) {
    const target = event.target;

    // Handle Delete button
    if (target.classList.contains("delete-btn")) {
    const questionItem = target.closest(".question-item");
    questionItem.remove();
    }

    // Handle Update button
    if (target.classList.contains("update-btn")) {
    const questionItem = target.closest(".question-item");
    alert("Question Updated: " + questionItem.querySelector("h6").innerText);
    }
});


     