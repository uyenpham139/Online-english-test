-- Create the Users table
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50)
);

-- Create the Admin, Staff, and Students tables
CREATE TABLE Admin (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Staff (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Students (
    id INT PRIMARY KEY,
    level VARCHAR(50),
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the Test table
CREATE TABLE Test (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    topic VARCHAR(255),
    level VARCHAR(50),
    start_time DATETIME,
    end_time DATETIME,
    staff_id INT,
    FOREIGN KEY (staff_id) REFERENCES Staff(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the Question table
CREATE TABLE Question (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    weight INT NOT NULL,
    type VARCHAR(50),
    pictures VARCHAR(255),
    test_id INT,
    FOREIGN KEY (test_id) REFERENCES Test(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the Answer table
CREATE TABLE Answer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correct_content TEXT NOT NULL,
    wrong_content TEXT,
    question_id INT,
    test_id INT,
    FOREIGN KEY (question_id) REFERENCES Question(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (test_id) REFERENCES Test(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the Submission table
CREATE TABLE Submission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    test_id INT,
    question_id INT,
    student_ans TEXT,
    score INT,
    FOREIGN KEY (student_id) REFERENCES Students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (test_id) REFERENCES Test(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (question_id) REFERENCES Question(id) ON DELETE CASCADE ON UPDATE CASCADE
);