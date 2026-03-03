-- Rose & Bloom Luxury Beauty Salon — PostgreSQL Schema
-- Run once on fresh DB or via Docker init

-- Admins table
CREATE TABLE IF NOT EXISTS admins (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Services table
CREATE TABLE IF NOT EXISTS services (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price NUMERIC(10,2) NOT NULL,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(150) NOT NULL,
    service_id INT REFERENCES services(id) ON DELETE SET NULL,
    appointment_date DATE NOT NULL,
    time_slot VARCHAR(20) NOT NULL,
    notes TEXT,
    status VARCHAR(20) DEFAULT 'waiting' CHECK (status IN ('waiting','confirmed','cancelled','completed')),
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Gallery table
CREATE TABLE IF NOT EXISTS gallery (
    id SERIAL PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    caption VARCHAR(200),
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Seed: default admin (username: admin, password: Admin@123)
-- Password hash for 'Admin@123' using PASSWORD_BCRYPT
INSERT INTO admins (username, password_hash)
VALUES ('admin', '$2y$12$eG8vf3iOJRqLlE3t9GdFJOZn9YwFOJjshVkDjfJn.7sJ0s9bBkz8G')
ON CONFLICT (username) DO NOTHING;

-- Seed: sample services
INSERT INTO services (name, description, price, image, is_active) VALUES
('Bridal Makeup', 'Complete bridal makeup with long-lasting, waterproof formulas for your perfect day.', 4999.00, NULL, TRUE),
('Hair Spa & Treatment', 'Deep conditioning and nourishing hair spa treatment to restore shine and softness.', 1499.00, NULL, TRUE),
('Nail Art & Extensions', 'Creative nail art designs and durable gel/acrylic nail extensions.', 899.00, NULL, TRUE),
('Facial & Skin Care', 'Luxury facial treatments tailored for glowing, healthy skin.', 1299.00, NULL, TRUE),
('Full Body Waxing', 'Smooth and gentle full body waxing using premium wax formulas.', 1799.00, NULL, TRUE),
('Eyebrow Shaping & Threading', 'Perfectly shaped eyebrows using threading and tinting techniques.', 299.00, NULL, TRUE)
ON CONFLICT DO NOTHING;

-- Create indexes for performance
CREATE INDEX IF NOT EXISTS idx_bookings_status ON bookings(status);
CREATE INDEX IF NOT EXISTS idx_bookings_date ON bookings(appointment_date);
CREATE INDEX IF NOT EXISTS idx_services_active ON services(is_active);
