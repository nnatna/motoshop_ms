CREATE DATABASE motoshop_db;
USE motoshop_db;

CREATE TABLE users (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_user VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'user') DEFAULT 'user'
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
    braid INT,
    modname VARCHAR(100) NOT NULL,
    color VARCHAR(100) NOT NULL,
    yearmade YEAR NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    FOREIGN KEY (braid) REFERENCES tblBrand(braid)
)AUTO_INCREMENT=1000001;

CREATE TABLE tblSales (
    saleid INT PRIMARY KEY AUTO_INCREMENT,
    cusid INT,
    code_model INT,
    quantity INT NOT NULL,
    amount DECIMAL(10, 2),
    saledate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cusid) REFERENCES tblCustomers(cusid),
    FOREIGN KEY (modid) REFERENCES tblModel(code_model)
) AUTO_INCREMENT=1001;

INSERT INTO users (username, password_user, full_name, role) VALUES
('admin', '1234', 'Admin User', 'admin'),
('sokvanna', '4321', 'Sok Vanna', 'user');
SELECT * FROM users;

INSERT INTO tblBrand (braname) VALUES
('Honda'),
('Yamaha'),
('Suzuki'),
('KTM');
SELECT * FROM tblBrand;


INSERT INTO tblModel (braid ,modname, color, yearmade, price, stock) VALUES
(1, 'Wave 110i',   'Red',    2020, 1350.00, 5),
(1, 'Click 125i',  'Blue',   2023, 1800.00, 3),
(1, 'PCX 150',     'Silver', 2025, 3200.00, 2),
(2, 'Exciter 150', 'Black',  2024, 2200.00, 4),
(2, 'NMAX 155',    'White',  2019, 2800.00, 2),
(3, 'Raider R150', 'Orange', 2017, 2100.00, 3),
(4, 'Duke 200',    'Black',  2026, 4500.00, 1);
SELECT * FROM tblModel;

INSERT INTO tblCustomers (cusname, gender, phone, address) 
VALUES
('Sok Vanna',  'Male',   '012345608', 'Phnom Penh'),
('Chan Dara',  'Male',   '098765432', 'Siem Reap'),
('Ly Sopha',   'Female', '011223344', 'Kampong Cham'),
('Heng Makara','Male',   '015667788', 'Battambang');
SELECT * FROM tblCustomers;

INSERT INTO tblSales (cusid, modid, quantity, amount) VALUES
(1, 1, 1, 1350.00),
(2, 4, 1, 2200.00),
(3, 2, 1, 1800.00),
(4, 6, 1, 2100.00);
SELECT * FROM tblSales;

CREATE OR REPLACE VIEW vsales AS
SELECT 
    s.saleid,
    c.cusname,
    c.phone,
    b.braname,
    m.modname,
    m.color,
    m.yearmade,
    s.quantity,
    s.amount,
    s.saledate
FROM tblSales s                                  
JOIN tblCustomers c ON s.cusid  = c.cusid        
JOIN tblModel     m ON s.code_model  = m.code_model        
JOIN tblBrand     b ON m.braid  = b.braid;       

SELECT * FROM vsales;
