--@block
drop table Residents;
drop table Wardens;
drop table Hostels;
drop table Users;
--@block
drop trigger unique_uuid_users;
drop trigger unique_uuid_hostels;
--@block
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
CREATE TRIGGER unique_uuid_users BEFORE
INSERT ON Users FOR EACH ROW BEGIN IF NEW.user_id IS NULL
    OR NEW.user_id = '' THEN
SET NEW.user_id = UUID();
END IF;
END;
CREATE TABLE IF NOT EXISTS Hostels(
    hostel_id CHAR(36) NOT NULL DEFAULT (UUID()),
    primary KEY (hostel_id),
    hostel_name varchar(255) NOT NULL,
    address varchar(255) not NULL,
    owner varchar(255) not null,
    capacity INT DEFAULT 0,
    amenities TEXT,
    date_of_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    warden_id CHAR(36) NOT NULL,
    FOREIGN KEY (warden_id) REFERENCES Wardens(warden_id) ON DELETE CASCADE,
);
CREATE TRIGGER unique_uuid_hostels BEFORE
INSERT ON Hostels FOR EACH ROW BEGIN IF NEW.hostel_id IS NULL
    OR NEW.hostel_id = '' THEN
SET NEW.hostel_id = UUID();
END IF;
END;
create table if not exists Wardens(
    warden_id char(36) not null,
    phone_number varchar(15) not null unique,
    monthly_salary decimal(10, 2) not null default(4000),
    foreign key (warden_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    PRIMARY key (warden_id),
);
create table if not exists Residents (
    resident_id char(36) not null,
    hostel_id char(36) not null,
    phone_number varchar(15) not null unique,
    room_number varchar(255) not null,
    monthly_rent decimal(10, 2) not null default(4000.00),
    status ENUM('active', 'inactive') not null default 'active',
    foreign key (resident_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    PRIMARY key (resident_id),
    foreign key (hostel_id) references Hostels(hostel_id) ON DELETE CASCADE
);
create table if not exists Maintenance(
    maintanance_id char(36) not null,
    hostel_id char(36) not null,
    description TEXT not null,
    amount decimal(10, 2) not null,
    status ENUM('pending', 'resolved') not null default 'pending',
    date_of_payment TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (hostel_id) references Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY key (maintanance_id),
);
create table if not exists Payments(
    payment_id char(36) not null,
    resident_id char(36) not null,
    hostel_id char(36) not null,
    amount decimal(10, 2) not null,
    date_of_payment TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (resident_id) references Residents(resident_id) ON DELETE CASCADE,
    foreign key (hostel_id) references Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY key (payment_id),
);
create table if not exists Complaints(
    complaint_id char(36) not null,
    resident_id char(36) not null,
    hostel_id char(36) not null,
    description TEXT not null,
    date_of_complaint TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'resolved') not null default 'pending',
    foreign key (resident_id) references Residents(resident_id) ON DELETE CASCADE,
    foreign key (hostel_id) references Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY key (complaint_id),
);
create table if not exists Feedbacks(
    feedback_id char(36) not null,
    user_id char(36) not null,
    feedback TEXT not null,
    date_of_feedback TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (user_id) references Users(user_id) ON DELETE CASCADE,
    PRIMARY key (feedback_id),
);
create table if not exists Announcements(
    announcement_id char(36) not null,
    hostel_id char(36) not null,
    announcement TEXT not null,
    date_of_announcement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (hostel_id) references Hostels(hostel_id) ON DELETE CASCADE,
    PRIMARY key (announcement_id),
);
--@block
INSERT INTO Users (username, email, password)
VALUES (
        'JohnDoe',
        'john.doe@example.com',
        'securepassword'
    );
--@block
DELETE FROM Users
WHERE username = 'JohnDoe';
--@block
SELECT *
from Users;
SELECT *
FROM Wardens;
SELECT *
from Residents;
SELECT *
from Hostels;