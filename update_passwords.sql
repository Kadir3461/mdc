-- Update password hashes for demo accounts
UPDATE users SET password = '$2y$10$81cryjBXax1KtUdKraxA0uiCEZcvD5CjWiUoGENSt/sa0V71riMHO' WHERE email = 'admin@mdc-fm.de';
UPDATE users SET password = '$2y$10$P6oEQnqjR339pUzaCt7wquGgnJtAwviz2Gw2cFZQtmvN2ytQZtJM2' WHERE email = 'kunde@beispiel.de';
