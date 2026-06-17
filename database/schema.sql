CREATE DATABASE IF NOT EXISTS webtech_solo CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE webtech_solo;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('open', 'bezig', 'klaar') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS sensor_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    battery INT,
    latitude DECIMAL(10, 7),
    longitude DECIMAL(10, 7),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, description, status) VALUES
('Voorbeeldtaak: database testen', 'Deze taak toont dat data uit MySQL wordt uitgelezen.', 'open'),
('Voorbeeldtaak: presentatie oefenen', 'Leg PHP, SQL, Ajax en REST uit.', 'bezig'),
('Voorbeeldtaak: README schrijven', 'Documentatie voor GitHub.', 'klaar');
