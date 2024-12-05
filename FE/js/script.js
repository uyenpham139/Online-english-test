let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}


document.addEventListener("DOMContentLoaded", () => {
   const searchForm = document.getElementById("searchForm");
   const searchInput = document.getElementById("searchInput");
   const levelFilter = document.getElementById("levels");
   const searchResults = document.getElementById("searchResults");

   // Example data to simulate a database or API response
   const testData = [
       { name: "Math Test", level: "Beginner", topic: "Daily" },
       { name: "Physics Exam", level: "Expert", topic: "Daily" },
       { name: "Chemistry Quiz", level: "Beginner", topic: "Office" },
       { name: "History Test", level: "Expert", topic: "Daily" },
       { name: "English Grammar Test", level: "Beginner", topic: "Work" },
   ];

   // Function to render search results
   function renderResults(results) {
       searchResults.innerHTML = ""; // Clear previous results
       if (results.length === 0) {
           searchResults.innerHTML = "<p>No results found.</p>";
           return;
       }
       results.forEach((result) => {
           const resultItem = document.createElement("div");
           resultItem.classList.add("result-item");
           resultItem.innerHTML = `<h3>${result.name}</h3><p>Level: ${result.level}</p><p>Topic: ${result.topic}</p>`;
           searchResults.appendChild(resultItem);
       });
   }

   // Event listener for the search form
   searchForm.addEventListener("submit", (e) => {
       e.preventDefault(); // Prevent page reload
       const keyword = searchInput.value.toLowerCase();
       const selectedLevel = levelFilter.value;

       // Filter the data based on user input
       const filteredResults = testData.filter((test) => {
           const matchesKeyword = test.name.toLowerCase().includes(keyword);
           const matchesLevel = selectedLevel === "" || test.level === selectedLevel;
           return matchesKeyword && matchesLevel;
       });

       // Render the filtered results
       renderResults(filteredResults);
   });
});
