CREATE DATABASE ctf_lab;
USE ctf_lab;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    info VARCHAR(255) NOT NULL
);

-- Flag base64 kodlu ("FLAG{sql_injection_123}")
INSERT INTO users (username, info) VALUES
('admin', 'RkxBR3tzcWxfaW5qZWN0aW9uXzEyM30=');

-- Sahte kullanıcılar
INSERT INTO users (username, info) VALUES
('guest', 'TWVya2VkIHN0b3J5'),
('test', 'VGVzdCBrYXJ5YWN0ZXJp'),
('user', 'Tm9ybWFsIGluZm9ybWF0aW9u');
