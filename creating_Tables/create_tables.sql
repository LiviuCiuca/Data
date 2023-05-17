CREATE TABLE LOCATION (
  LOC_ID INT AUTO_INCREMENT PRIMARY KEY,
  LOC_NAME VARCHAR(50),
  ADDRESS VARCHAR(255),
  COUNTRY VARCHAR(50)
);


CREATE TABLE DEPARTMENT (
  DEPT_ID INT AUTO_INCREMENT PRIMARY KEY,
  DEPT_NAME VARCHAR(50),
  LOC_ID INT,
  FOREIGN KEY (LOC_ID) REFERENCES LOCATION(LOC_ID)
);

CREATE TABLE EMPLOYEE (
  EMPNO INT AUTO_INCREMENT PRIMARY KEY,
  ENAME VARCHAR(50),
  JOB VARCHAR(50),
  MGR INT,
  HIREDATE DATETIME,
  SAL DECIMAL(7, 2),
  COMM DECIMAL(7, 2),
  DEPTNO INT,
  FOREIGN KEY (DEPTNO) REFERENCES DEPARTMENT(DEPT_ID)
);


CREATE TABLE BENEFIT (
  BENEFIT_ID INT AUTO_INCREMENT PRIMARY KEY,
  BENEFIT_NAME VARCHAR(50),
  DESCRIPTION VARCHAR(255)

);

CREATE TABLE EMPLOYEE_BENEFIT (
  EMP_ID INT,
  BENEFIT_ID INT,
  FOREIGN KEY (EMP_ID) REFERENCES EMPLOYEE(EMPNO),
  FOREIGN KEY (BENEFIT_ID) REFERENCES BENEFIT(BENEFIT_ID)
);


-- Insert data into the LOCATION table
INSERT INTO LOCATION (LOC_NAME, ADDRESS, COUNTRY)
VALUES
  ('New York Office', '123 Main St, New York, USA', 'USA'),
  ('London Office', '456 Park Lane, London, UK', 'UK'),
  ('San Francisco Office', '789 Elm Street, San Francisco, USA', 'USA'),
  ('Tokyo Office', '10 Sakura Avenue, Tokyo, Japan', 'Japan'),
  ('Sydney Office', '555 Ocean Road, Sydney, Australia', 'Australia'),
  ('Berlin Office', '987 Lindenstrasse, Berlin, Germany', 'Germany'),
  ('Toronto Office', '321 Maple Avenue, Toronto, Canada', 'Canada');

-- Insert data into the DEPARTMENT table
INSERT INTO DEPARTMENT (DEPT_NAME, LOC_ID)
VALUES
  ('Sales', 1),
  ('Marketing', 1),
  ('Engineering', 2),
  ('Human Resources', 3),
  ('Finance', 4),
  ('Operations', 5),
  ('Customer Support', 6);

-- Insert data into the EMPLOYEE table
INSERT INTO EMPLOYEE (ENAME, JOB, MGR, HIREDATE, SAL, COMM, DEPTNO)
VALUES
  ('John Smith', 'Manager', NULL, '2022-01-01', 5000.00, NULL, 1),
  ('Jane Doe', 'Sales Representative', 1, '2022-02-01', 3000.00, 500.00, 1),
  ('Mark Johnson', 'Marketing Specialist', 1, '2022-03-01', 3500.00, NULL, 2),
  ('Sarah Williams', 'Software Engineer', 3, '2022-04-01', 4000.00, NULL, 3),
  ('Michael Brown', 'Sales Representative', 1, '2022-05-01', 3200.00, 400.00, 1),
  ('Emily Davis', 'Marketing Coordinator', 3, '2022-06-01', 3000.00, NULL, 2),
  ('David Miller', 'Software Engineer', 4, '2022-07-01', 4500.00, NULL, 3),
  ('Olivia Wilson', 'Human Resources Manager', NULL, '2022-08-01', 5500.00, NULL, 4),
  ('Daniel Thompson', 'Finance Analyst', 5, '2022-09-01', 3800.00, NULL, 5),
  ('Sophia Lee', 'Operations Coordinator', 6, '2022-10-01', 3200.00, NULL, 6),
  ('William Clark', 'Customer Support Representative', 7, '2022-11-01', 2800.00, NULL, 7);


-- Insert data into the BENEFIT table
INSERT INTO BENEFIT (BENEFIT_NAME, DESCRIPTION)
VALUES
  ('Health Insurance', 'Comprehensive health insurance coverage'),
  ('Paid Time Off', 'Paid vacation and sick leave'),
  ('Retirement Plan', '401(k) matching contributions'),
  ('Flexible Work Hours', 'Ability to set flexible work schedule'),
  ('Training and Development', 'Opportunities for professional growth and skill development'),
  ('Performance Bonuses', 'Bonuses based on performance metrics'),
  ('Gym Membership', 'Access to a company-sponsored gym facility');

-- Insert data into the EMPLOYEE_BENEFIT table
INSERT INTO EMPLOYEE_BENEFIT (EMP_ID, BENEFIT_ID)
VALUES
  (2, 1),
  (3,1),
  (4, 1),
  (4, 2),
  (4, 3),
  (5, 1),
  (6, 1),
  (7, 1),
  (7, 2),
  (7, 3),
  (8, 1),
  (9, 1),
  (9, 2),
  (10, 1),
  (10, 3);
 

