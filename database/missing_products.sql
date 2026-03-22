-- Example SQL insert statements for missing products (stock_quantity = 1000)
INSERT INTO products (name, description, price, category, material, image_url, stock_quantity, created_at, updated_at) VALUES
('Pearl Drop Earring', 'Elegant pearl drop earrings that add a touch of sophistication to any outfit. Perfect complement to any outfit with subtle elegance.', 275, 'Earrings', NULL, 'images/pearl-drop-earring.jpg', 1000, NOW(), NOW()),
('Silver Stud Earring', 'A sparkling silver stud earring that adds a touch of glamour to any look. Perfect complement to any outfit with subtle elegance.', 145, 'Earrings', NULL, 'images/silver-stud-earring.jpg', 1000, NOW(), NOW()),
('Bleeding Heart Bracelet', 'Handcrafted bracelet with romantic detailing. A statement piece celebrating love and craftsmanship.', 245, 'Bracelets', NULL, 'images/bleeding-heart-bracelet.jpg', 1000, NOW(), NOW()),
('Gold Bangle Bracelet', 'Golden baddazzling heavy bangle bracelet perfect for weddings and special occasions. A statement piece celebrating love and craftsmanship.', 380, 'Bracelets', NULL, 'images/gold-bangle-bracelet.jpg', 1000, NOW(), NOW());

-- Add more products as needed following this pattern.
