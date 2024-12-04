-- Create the Users table
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50),
    middle_name VARCHAR(100),
    last_name VARCHAR(50),
    role ENUM ("Admin", "Staff", "Student")
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
    level ENUM('Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'),
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE PROCEDURE insert_user(
    IN p_user_password VARCHAR(255),
    IN p_email VARCHAR(100),
    IN p_first_name VARCHAR(50),
    IN p_middle_name VARCHAR(100),
    IN p_last_name VARCHAR(50),
    IN p_user_role ENUM("Admin", "Staff", "Student"),
    IN p_level ENUM('Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert')
)
BEGIN
    declare exit handler for sqlexception rollback;

    start transaction;
    -- Insert into the users table
    INSERT INTO Users (user_password, email, firstname, middlename, lastname, role)
    VALUES (p_user_password, p_email, p_first_name, p_middle_name, p_last_name, p_user_role);

    -- Get the newly inserted user ID
    SET @new_user_id = LAST_INSERT_ID();

    -- Insert into the corresponding role table
    CASE p_user_role
        WHEN 'Admin' THEN
            INSERT INTO Admin(id)
            VALUES (@new_user_id);
        WHEN 'Staff' THEN
            INSERT INTO Staff(id)
            VALUES (@new_user_id);
        WHEN 'Student' THEN
            INSERT INTO Students(id, level)
            VALUES (@new_user_id, p_level);
    END CASE;

    commit;
END;

-- Create the Test table
CREATE TABLE Test (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    topic VARCHAR(255),
    level ENUM('Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'),
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
    content TEXT NOT NULL,
    question_id INT,
    test_id INT,
    correct BOOLEAN,
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
