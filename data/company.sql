-- Initial setup, reset if data exists
DROP DATABASE IF EXISTS company;
CREATE DATABASE company;
USE company;

-- Resets tables if they exist
DROP TABLE IF EXISTS department;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS project;

-- Create tables
CREATE TABLE department (
  departmentId INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL
);
CREATE TABLE employee (
    employeeId INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    birth DATE NOT NULL,
    departmentId INT NOT NULL,
    FOREIGN KEY (departmentId) REFERENCES department(departmentId)
)
CREATE TABLE project (
    projectId INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
)
CREATE TABLE employee_project (
    employeeId INT NOT NULL,
    projectId INT NOT NULL,
    FOREIGN KEY (employeeId) REFERENCES employee(employeeId),
    FOREIGN KEY (projectId) REFERENCES project(projectId),
    PRIMARY KEY (employeeId, projectId)
)
-- Insert Data
INSERT INTO department (name) VALUES
('Unassigned'), 
('HR'), 
('IT'), 
('Finance');

INSERT INTO project (name) VALUES 
('Project 1'), 
('Project 2'), 
('Project 3');

-- Insert sample employees (50 records)
INSERT INTO employee (firstName, lastName, email, birth, departmentID) VALUES
('John', 'Doe', 'john.doe@example.com', '1985-06-15', 1),
('Jane', 'Smith', 'jane.smith@example.com', '1990-04-22', 2),
('Michael', 'Brown', 'michael.brown@example.com', '1982-12-10', 3),
('Emily', 'Davis', 'emily.davis@example.com', '1993-03-30', 1),
('David', 'Wilson', 'david.wilson@example.com', '1987-09-14', 2),
('Emma', 'Taylor', 'emma.taylor@example.com', '1995-07-21', 3),
('Chris', 'Anderson', 'chris.anderson@example.com', '1984-05-18', 1),
('Olivia', 'Martinez', 'olivia.martinez@example.com', '1992-08-27', 2),
('Daniel', 'Thomas', 'daniel.thomas@example.com', '1988-11-11', 3);

-- Insert sample employee_project records
INSERT INTO employee_project (employeeId, projectId) VALUES
-- Project 1
(1, 1), (4, 1), (7, 1),
-- Project 2
(2, 2), (5, 2), (8, 2),
-- Project 3
(3, 3), (6, 3), (9, 3)
