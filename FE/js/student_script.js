let timeLeft = 300; // 5 minutes

        // Function to format time as MM:SS
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        // Function to update the countdown timer
        function updateTimer() {
            const timerElement = document.getElementById('timer');
            timerElement.textContent = formatTime(timeLeft);

            if (timeLeft > 0) {
                timeLeft--;
            } else {
                clearInterval(timerInterval);
                alert("Time's up!");
                // Optionally, redirect to another page or submit the test
                // window.location.href = "submit_test.php";
            }
        }

        // Start the countdown timer
        const timerInterval = setInterval(updateTimer, 1000);

// Array of questions
const questions = [
   {
     id: 1,
     text: "What changes occurred in the Lakeside area between 2000 and 2009?",
     image: "https://images.ctfassets.net/unrdeg6se4ke/6nAtB7KmpGQmUMT0Ys1xgO/2612ce73a97b068f6d1f78352079d5aa/map-the-hien-su-thay-doi-cua-khu-vuc-lakeside-tu-2000-den-2009.jpg?&w=1220",
     options: ["Option A", "Option B", "Option C", "Option D"],
   },
   {
     id: 2,
     text: "Which country has the highest population?",
     image: "",
     options: ["India", "China", "USA", "Brazil"],
   }
 ];
 
 // Populate questions on the page
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
 
 // Handle form submission
 document.getElementById("testForm").addEventListener("submit", function (e) {
   e.preventDefault();
 
   const formData = new FormData(this);
   const answers = {};
 
   questions.forEach((question) => {
     answers[question.id] = formData.get(`question-${question.id}`) || "Not Answered";
   });
 
   console.log("Submitted Answers:", answers);
 
   // Show a confirmation message
   alert("Test submitted successfully! Check the console for the submitted answers.");
 });
 