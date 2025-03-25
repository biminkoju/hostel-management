-- Users table
CREATE TABLE IF NOT EXISTS Users (
    user_id CHAR(36) NOT NULL DEFAULT (''),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    account_type ENUM('resident', 'warden') NOT NULL DEFAULT 'resident',
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id)
);
-- Users trigger
CREATE TRIGGER unique_uuid_users BEFORE
INSERT ON Users FOR EACH ROW BEGIN IF NEW.user_id IS NULL
    OR NEW.user_id = '' THEN
SET NEW.user_id = UUID();
END IF;
END;
-- Wardens table (moved up since Hostels references it)
CREATE TABLE IF NOT EXISTS Wardens(
    warden_id CHAR(36) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    phone_number VARCHAR(15) NOT NULL UNIQUE,
    address VARCHAR(255) NOT NULL,
    monthly_salary DECIMAL(10, 2) NOT NULL DEFAULT 4000,
    FOREIGN KEY (warden_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (warden_id)
);
-- Hostels table
CREATE TABLE IF NOT EXISTS Hostels(
    hostel_id CHAR(36) NOT NULL DEFAULT (''),
    hostel_name VARCHAR(255) NOT NULL,
    hostel_address VARCHAR(255) NOT NULL,
    hostel_owner VARCHAR(255) NOT NULL,
    hostel_capacity INT DEFAULT 0,
    amenities TEXT,
    description TEXT,
    date_of_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    warden_id CHAR(36) NOT NULL,
    PRIMARY KEY (hostel_id),
    FOREIGN KEY (warden_id) REFERENCES Wardens(warden_id) ON DELETE CASCADE
);
-- Hostels trigger
CREATE TRIGGER unique_uuid_hostels BEFORE
INSERT ON Hostels FOR EACH ROW BEGIN IF NEW.hostel_id IS NULL
    OR NEW.hostel_id = '' THEN
SET NEW.hostel_id = UUID();
END IF;
END;
-- Residents table
CREATE TABLE IF NOT EXISTS Residents (
    resident_id CHAR(36) NOT NULL,
    hostel_id CHAR(36) NOT NULL,
    phone_number VARCHAR(15) NOT NULL UNIQUE,
    room_number VARCHAR(255) NOT NULL,
    monthly_rent DECIMAL(10, 2) NOT NULL DEFAULT 4000.00,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    FOREIGN KEY (resident_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (hostel_id) REFERENCES Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY KEY (resident_id)
);
-- Maintenance table
CREATE TABLE IF NOT EXISTS Maintenance(
    maintanance_id CHAR(36) NOT NULL,
    hostel_id CHAR(36) NOT NULL,
    description TEXT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'resolved') NOT NULL DEFAULT 'pending',
    date_of_payment TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hostel_id) REFERENCES Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY KEY (maintanance_id)
);
-- Payments table
CREATE TABLE IF NOT EXISTS Payments(
    payment_id CHAR(36) NOT NULL,
    resident_id CHAR(36) NOT NULL,
    hostel_id CHAR(36) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date_of_payment TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (resident_id) REFERENCES Residents(resident_id) ON DELETE CASCADE,
    FOREIGN KEY (hostel_id) REFERENCES Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY KEY (payment_id)
);
-- Complaints table
CREATE TABLE IF NOT EXISTS Complaints(
    complaint_id CHAR(36) NOT NULL,
    resident_id CHAR(36) NOT NULL,
    hostel_id CHAR(36) NOT NULL,
    description TEXT NOT NULL,
    date_of_complaint TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'resolved') NOT NULL DEFAULT 'pending',
    FOREIGN KEY (resident_id) REFERENCES Residents(resident_id) ON DELETE CASCADE,
    FOREIGN KEY (hostel_id) REFERENCES Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY KEY (complaint_id)
);
-- Feedbacks table
CREATE TABLE IF NOT EXISTS Feedbacks(
    feedback_id CHAR(36) NOT NULL,
    user_id CHAR(36) NOT NULL,
    feedback TEXT NOT NULL,
    date_of_feedback TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (feedback_id)
);
-- Announcements table
CREATE TABLE IF NOT EXISTS Announcements(
    announcement_id CHAR(36) NOT NULL,
    hostel_id CHAR(36) NOT NULL,
    announcement TEXT NOT NULL,
    date_of_announcement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hostel_id) REFERENCES Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY KEY (announcement_id)
);