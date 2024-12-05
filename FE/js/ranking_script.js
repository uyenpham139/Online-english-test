// Example Data: Store student's name and score (Level will be determined based on the score)
let studentsScores = [
    { name: 'Alice', score: 850 },
    { name: 'Bob', score: 950 },
    { name: 'Charlie', score: 750 },
    { name: 'Diana', score: 1050 },
    { name: 'Eve', score: 550 }
];

// Function to assign level based on score
function getLevel(score) {
    if (score > 1000) {
        return 'Expert';
    } else if (score > 800) {
        return 'Advanced';
    } else if (score > 600) {
        return 'Experienced';
    } else if (score > 400) {
        return 'Intermediate';
    } else {
        return 'Beginner';
    }
}

// Function to update the leaderboard
function updateLeaderboard() {
    // Sort students based on scores (descending)
    studentsScores.sort((a, b) => b.score - a.score);

    // Get the leaderboard table body
    const leaderboard = document.getElementById("leaderboard");
    leaderboard.innerHTML = '';  // Clear previous leaderboard

    // Add rows for each student
    studentsScores.forEach((student, index) => {
        // Assign the level based on the student's score
        student.level = getLevel(student.score);

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${student.name}</td>
            <td>${student.level}</td> <!-- Add the Level -->
            <td>${student.score}</td>
        `;
        leaderboard.appendChild(row);
    });
}

// Call the function to display leaderboard
updateLeaderboard();
