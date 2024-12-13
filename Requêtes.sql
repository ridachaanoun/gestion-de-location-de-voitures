1. Afficher les contrats de location avec les noms des clients et des voitures
SELECT 
    rental_contracts.id, 
    rental_contracts.rental_date, 
    rental_contracts.return_date, 
    rental_contracts.total_amount, 
    clients.name AS client_name, 
    cars.marque AS car_make, 
    cars.modele AS car_model
FROM 
    rental_contracts
JOIN 
    clients ON rental_contracts.client_id = clients.id
JOIN 
    cars ON rental_contracts.car_id = cars.matric;

2. Afficher les utilisateurs avec leurs tokens valides

SELECT 
    users.username, 
    personal_access_tokens.token, 
    personal_access_tokens.expires_at
FROM 
    personal_access_tokens
JOIN 
    users ON personal_access_tokens.user_id = users.id
WHERE 
    personal_access_tokens.expires_at > NOW();

3.  Ajouter un nouveau contrat de location

INSERT INTO rental_contracts (client_id, car_id, rental_date, return_date, total_amount) 
VALUES (1, 'ABC123', '2023-12-10', '2023-12-15', 300.00);

4. Supprimer un contrat de location

DELETE FROM rental_contracts 
WHERE id = 1;
