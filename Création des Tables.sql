-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Table des tokens d'accès personnel
CREATE TABLE personal_access_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL UNIQUE,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table des clients
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    phone_number VARCHAR(15),
    email VARCHAR(100) UNIQUE
);

-- Table des voitures
CREATE TABLE cars (
    matric VARCHAR(255) PRIMARY KEY,
    marque VARCHAR(255) NOT NULL,
    modele VARCHAR(255) NOT NULL,
    annee INT NOT NULL
);

-- Table des contrats de location
CREATE TABLE rental_contracts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    car_id VARCHAR(255) NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE,
    total_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES cars(matric) ON DELETE CASCADE
);
