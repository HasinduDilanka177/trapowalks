CREATE DATABASE IF NOT EXISTS trapowalks
    CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE trapowalks;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    destination VARCHAR(100) NOT NULL,
    travel_date DATE NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password) VALUES
('demo_walker', 'demo@trapowalks.lk',
 '$2b$10$93PrW1Tt.Hbaz0uTMz45WOdUbZWz6IPBe7wjld2hzqqzJlZE5OLh2');

INSERT INTO messages (name, email, message) VALUES
('Kasun Perera', 'kasun@gmail.com', 'Hi! Do you arrange group hikes to Knuckles mountain range?'),
('Fathima Rizna', 'fathima@yahoo.com', 'Please send me the Yala safari price list for December.');

INSERT INTO trips (user_id, destination, travel_date, notes) VALUES
(1, 'Ella', '2026-12-20', 'Nine Arches bridge at sunrise, Little Adam''s Peak hike, tea factory visit.'),
(1, 'Mirissa', '2026-12-24', 'Whale watching 6 AM, coconut tree hill for sunset.');
