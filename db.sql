-- Bảng accounts
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'department', 'student') NOT NULL,
    isdeleted TINYINT(1) DEFAULT 0,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng infos
CREATE TABLE infos (
    mssv VARCHAR(20) PRIMARY KEY,
    accountid INT NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    birthday DATE,
    classid VARCHAR(20),
    mail VARCHAR(100) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (accountid) REFERENCES accounts(id) ON DELETE CASCADE
);

-- Bảng classrooms
CREATE TABLE classrooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classname VARCHAR(50) NOT NULL,
    classid VARCHAR(20) NOT NULL UNIQUE,
    courseyear YEAR NOT NULL
);

-- Bảng teachers
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    qualification ENUM('Thạc sĩ', 'Tiến sĩ') NOT NULL,
    teacher_code VARCHAR(20) NOT NULL UNIQUE,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng projects
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projectname VARCHAR(100) NOT NULL,
    projecttype VARCHAR(50) NOT NULL,
    mssv VARCHAR(20),
    totalscore DECIMAL(5,2),
    rating ENUM('Excellent', 'Good', 'Fair', 'Poor'),
    teacherid INT,
    status ENUM('completed', 'notcompleted') NOT NULL DEFAULT 'notcompleted',
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mssv) REFERENCES infos(mssv) ON DELETE CASCADE,
    FOREIGN KEY (teacherid) REFERENCES teachers(id) ON DELETE SET NULL
);
