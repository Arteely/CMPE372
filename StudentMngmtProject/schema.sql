CREATE DATABASE group6;
USE group6;
CREATE TABLE faculties(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE users(
    id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    faculty_id VARCHAR(255) NOT NULL,
    faculty_ref INTEGER NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    PRIMARY KEY(id),
    FOREIGN KEY(faculty_ref) REFERENCES faculties(id)
);
CREATE TABLE courses(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    ext_name VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INTEGER NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(teacher_id) REFERENCES users(id)
);
CREATE TABLE students(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    surname VARCHAR(255) NOT NULL UNIQUE,
    student_id INTEGER NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE students_courses(
    course_id INTEGER NOT NULL,
    student_id INTEGER NOT NULL,
    PRIMARY KEY(course_id , student_id),
    FOREIGN KEY(course_id) REFERENCES courses(id),
    FOREIGN KEY(student_id) REFERENCES students(id)
);
CREATE TABLE lectures(
    id INTEGER NOT NULL AUTO_INCREMENT,
    course_id INTEGER NOT NULL,
    course_type ENUM('inperson', 'remote-zoom') NOT NULL DEFAULT 'inperson',
    start DATETIME NOT NULL,
    end DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(course_id) REFERENCES courses(id)
);
CREATE TABLE homeworks(
    id INTEGER NOT NULL AUTO_INCREMENT,
    course_id INTEGER NOT NULL,
    int_lecture INTEGER NOT NULL,
    due DATETIME NOT NULL,
    doc_ref CHAR(64) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(course_id) REFERENCES courses(id),
    FOREIGN KEY(int_lecture) REFERENCES lectures(id)
);
