CREATE DATABASE group6;
USE group6;
CREATE TABLE users(
    id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    faculty_id VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);
CREATE TABLE courses(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
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
