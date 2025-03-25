-- First drop triggers
DROP TRIGGER IF EXISTS unique_uuid_users;
DROP TRIGGER IF EXISTS unique_uuid_hostels;
-- Then drop tables in reverse dependency order
DROP TABLE IF EXISTS Announcements;
DROP TABLE IF EXISTS Feedbacks;
DROP TABLE IF EXISTS Complaints;
DROP TABLE IF EXISTS Payments;
DROP TABLE IF EXISTS Maintenance;
DROP TABLE IF EXISTS Residents;
DROP TABLE IF EXISTS Hostels;
DROP TABLE IF EXISTS Wardens;
DROP TABLE IF EXISTS Users;