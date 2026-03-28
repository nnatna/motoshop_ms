CREATE DATABASE motoshop_db;
USE motoshop_db;

CREATE TABLE tbluser (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    username VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'User') DEFAULT 'User'
);

CREATE TABLE tblCustomers (
    cusid INT PRIMARY KEY AUTO_INCREMENT,
    cusname VARCHAR(100) NOT NULL,
    gender VARCHAR(10),
    phone VARCHAR(20) UNIQUE,
    address VARCHAR(100)
);

CREATE TABLE tblBrand (
    braid INT PRIMARY KEY AUTO_INCREMENT,
    braname VARCHAR(100) NOT NULL	
);

CREATE TABLE tblModel (
    code_model INT PRIMARY KEY AUTO_INCREMENT,
    braid INT NOT NULL,
    modname VARCHAR(100) NOT NULL,
    color VARCHAR(100) NOT NULL,
    `year` YEAR NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    act VARCHAR(5) NOT NULL,
    stock INT DEFAULT 0,
    FOREIGN KEY (braid) REFERENCES tblBrand(braid)
)AUTO_INCREMENT=8000001;

CREATE TABLE tblSales (
    saleid INT PRIMARY KEY AUTO_INCREMENT,
    cusid INT NOT NULL,
    code_model INT NOT NULL,
    quantity INT NOT NULL,
    amount DECIMAL(10, 2),
    saledate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cusid) REFERENCES tblCustomers(cusid),
    FOREIGN KEY (code_model) REFERENCES tblModel(code_model)
) AUTO_INCREMENT=1001;

INSERT INTO users (username, password_user, full_name, role) VALUES
('admin', '1234', 'Admin User', 'Admin'),
('sokvanna', '4321', 'Sok Vanna', 'User');
SELECT * FROM users;

INSERT INTO tblBrand (braname) VALUES
('Honda'),
('Yamaha'),
('Suzuki'),
('KTM');
SELECT * FROM tblBrand;


INSERT INTO tblModel (braid ,modname, color, `year`, price, act, stock) VALUES
(1, 'Wave 110i',   'Red',    2020, 1350.00,'Used', 5),
(1, 'Click 125i',  'Blue',   2023, 1800.00,'New', 3),
(1, 'PCX 150',     'Silver', 2025, 3200.00,'Used', 2),
(2, 'Exciter 150', 'Black',  2024, 2200.00,'New', 4),
(2, 'NMAX 155',    'White',  2019, 2800.00,'New', 2),
(3, 'Raider R150', 'Orange', 2017, 2100.00,'Used', 3),
(4, 'Duke 200',    'Black',  2026, 4500.00,'New', 1);
SELECT * FROM tblModel;

INSERT INTO tblCustomers (cusname, gender, phone, address) 
VALUES
('Sok Vanna',  'Male',   '012345608', 'Phnom Penh'),
('Chan Dara',  'Male',   '098765432', 'Siem Reap'),
('Ly Sopha',   'Female', '011223344', 'Kampong Cham'),
('Heng Makara','Male',   '015667788', 'Battambang');
SELECT * FROM tblCustomers;

INSERT INTO tblSales (cusid, code_model, quantity, amount) VALUES
(1, 8000001, 1, 1350.00),
(2, 8000004, 1, 2200.00),
(3, 8000002, 1, 1800.00),
(4, 8000006, 1, 2100.00);
SELECT * FROM tblSales;

CREATE OR REPLACE VIEW vsales AS
SELECT 
    s.saleid,
    c.cusname,
    c.phone,
    b.braname,
    m.code_model,
    m.color,
    m.year,
    s.quantity,
    s.amount,
    s.saledate
FROM tblSales s                                  
JOIN tblCustomers c ON s.cusid  = c.cusid        
JOIN tblModel     m ON s.code_model  = m.code_model        
JOIN tblBrand     b ON m.braid  = b.braid;       

SELECT * FROM vsales;
