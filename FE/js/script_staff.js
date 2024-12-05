const questionsList = document.getElementById("questionsList");

const questionsOverview = document.getElementById("questionsOverview");

// Add Question Functionality
document.getElementById("addQuestionBtn").addEventListener("click", function () {
    const questionId = new Date().getTime(); // Unique ID for each question
    const questionText = `Question ${questionsList.childElementCount + 1}`;

    const questionItemHtml = `
    <div class="question-item" data-id="${questionId}">
         <label for="question-${questionId}">Question:</label>
        <input type="text" id="question-${questionId}" class="form-control" placeholder="Enter your question">
        <input type="file" class="form-control" id="questionImage" accept="image/png, image/jpeg">
        <img id="previewImage" class="image-preview" alt="Image Preview">
        <div class="options">
            <label>A:</label>
            <input type="text" class="form-control" value="Option A">
            <label>B:</label>
            <input type="text" class="form-control" value="Option B">
            <label>C:</label>
            <input type="text" class="form-control" value="Option C">
            <label>D:</label>
            <input type="text" class="form-control" value="Option D">
        </div>
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
        
        </div>
    </div>
    `;

    questionsList.insertAdjacentHTML("beforeend", questionItemHtml);

     // Add to overview list
     const overviewItemHtml = `
     <li data-id="${questionId}">
         <span>${questionText}</span>
         <button class="btn btn-sm btn-danger delete-overview-btn">Delete</button>
     </li>`;
     questionsOverview.insertAdjacentHTML("beforeend", overviewItemHtml);

    const fileInput = document.getElementById('questionImage');
    const previewImage = document.getElementById('previewImage');

    const fileInputs = questionsList.querySelectorAll('.questionImage');
    fileInputs.forEach(fileInput => {
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            const previewImage = this.nextElementSibling;
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
            }
        });
    });


    
});


// Event delegation for Update and Delete buttons
questionsList.addEventListener("click", function (event) {
    const target = event.target;

    // Handle Delete button in question container
    if (target.classList.contains("delete-btn")) {
        const questionItem = target.closest(".question-item");
        const questionId = questionItem.dataset.id;

        // Remove the question from the list
        questionItem.remove();

        // Remove the corresponding overview entry
        const overviewItem = questionsOverview.querySelector(`[data-id="${questionId}"]`);
        if (overviewItem) overviewItem.remove();
    }
});

questionsOverview.addEventListener("click", function (event) {
    const target = event.target;

    // Handle Delete button in the overview list
    if (target.classList.contains("delete-overview-btn")) {
        const overviewItem = target.closest("li");
        const questionId = overviewItem.dataset.id;

        // Remove the question from the container
        const questionItem = questionsList.querySelector(`[data-id="${questionId}"]`);
        if (questionItem) questionItem.remove();

        // Remove the overview entry
        overviewItem.remove();
    }
});


     