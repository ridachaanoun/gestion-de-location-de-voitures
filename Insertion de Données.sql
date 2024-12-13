-- Insérer des utilisateurs
INSERT INTO users (username, email, password) VALUES
('john_doe', 'john@example.com', '123456'),
('jane_doe', 'jane@example.com', '123456');

-- Insérer des clients
INSERT INTO clients (name, address, phone_number, email) VALUES
('Alice Smith', '123 Main St', '1234567890', 'alice@example.com'),
('Bob Johnson', '456 Elm St', '9876543210', 'bob@example.com');

-- Insérer des voitures
INSERT INTO cars (matric, marque, modele, annee) VALUES
('ABC123', 'Toyota', 'Corolla', 2020),
('DEF456', 'Honda', 'Civic', 2019);

-- Insérer des contrats de location
INSERT INTO rental_contracts (client_id, car_id, rental_date, return_date, total_amount) VALUES
(1, 'ABC123', '2023-12-01', '2023-12-05', 200.00),
(2, 'DEF456', '2023-12-02', '2023-12-06', 250.00);
