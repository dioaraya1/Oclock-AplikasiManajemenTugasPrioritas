-- Insert admin default (password: admin123)
INSERT INTO users (username, email, password, full_name, role) 
VALUES ('admin', 'admin@oclock.com', '$2y$10$YourHashedPassword', 'Administrator', 'admin');