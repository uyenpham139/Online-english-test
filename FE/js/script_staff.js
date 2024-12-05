const questionsList = document.getElementById("questionsList");

// Add Question Functionality
document.getElementById("addQuestionBtn").addEventListener("click", function () {
    const questionId = new Date().getTime(); // Unique ID for each question
    const questionItemHtml = `
    <div class="question-item" data-id="${questionId}">
        <h6 contenteditable="true">New Question (Click to Edit)</h6>
        <input type="file" class="form-control" id="questionImage" accept="image/png, image/jpeg">
        <img id="previewImage" class="image-preview" alt="Image Preview">
        <p contenteditable="true">A. Option A</p>
        <p contenteditable="true">B. Option B</p>
        <p contenteditable="true">C. Option C</p>
        <p contenteditable="true">D. Option D</p>
        <div class="correct-answer">
            <label for="correct-answer-${questionId}">Correct Answer:</label>
            <select id="correct-answer-${questionId}" class="form-control">
                <option value="A">Option A</option>
                <option value="B">Option B</option>
                <option value="C">Option C</option>
                <option value="D">Option D</option>
            </select>
        <div class="question-actions">
        <button class="btn btn-warning btn-sm update-btn">Update</button>
        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
        </div>
    </div>
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


     