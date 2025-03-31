-- Insert sample Users
INSERT INTO Users (username, email, password, account_type, bio)
VALUES (
        'john_doe',
        'john.doe@example.com',
        'password123',
        'warden',
        'Experienced hostel warden with 10 years of experience'
    ),
    (
        'jane_smith',
        'jane.smith@example.com',
        'password123',
        'warden',
        'Senior warden specializing in student accommodations'
    ),
    (
        'bob_johnson',
        'bob.johnson@example.com',
        'password123',
        'resident',
        'Graduate student studying Computer Science'
    ),
    (
        'alice_williams',
        'alice.williams@example.com',
        'password123',
        'resident',
        'Medical student in final year'
    ),
    (
        'charlie_brown',
        'charlie.brown@example.com',
        'password123',
        'resident',
        'Working professional in IT sector'
    ),
    (
        'diana_prince',
        'diana.prince@example.com',
        'password123',
        'resident',
        'Exchange student from France'
    ),
    (
        'edward_stark',
        'edward.stark@example.com',
        'password123',
        'resident',
        'Engineering student'
    ),
    (
        'fiona_green',
        'fiona.green@example.com',
        'password123',
        'resident',
        'Business administration student'
    ),
    (
        'george_miller',
        'george.miller@example.com',
        'password123',
        'resident',
        'Law student'
    ),
    (
        'hannah_baker',
        'hannah.baker@example.com',
        'password123',
        'resident',
        'Arts major'
    );
-- Get the generated UUIDs for further use
SET @warden1_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'john.doe@example.com'
    );
SET @warden2_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'jane.smith@example.com'
    );
SET @resident1_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'bob.johnson@example.com'
    );
SET @resident2_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'alice.williams@example.com'
    );
SET @resident3_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'charlie.brown@example.com'
    );
SET @resident4_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'diana.prince@example.com'
    );
SET @resident5_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'edward.stark@example.com'
    );
SET @resident6_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'fiona.green@example.com'
    );
SET @resident7_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'george.miller@example.com'
    );
SET @resident8_id = (
        SELECT user_id
        FROM Users
        WHERE email = 'hannah.baker@example.com'
    );
-- Insert Wardens
INSERT INTO Wardens (
        warden_id,
        full_name,
        date_of_birth,
        phone_number,
        address,
        monthly_salary
    )
VALUES (
        @warden1_id,
        'John Doe',
        '1975-05-15',
        '+1234567890',
        '123 Main St, City',
        5000.00
    ),
    (
        @warden2_id,
        'Jane Smith',
        '1980-08-22',
        '+0987654321',
        '456 Oak Ave, Town',
        4800.00
    );
-- Insert Hostels
INSERT INTO Hostels (
        hostel_name,
        hostel_address,
        hostel_owner,
        hostel_capacity,
        amenities,
        description,
        warden_id
    )
VALUES (
        'Sunrise Hostel',
        '789 Pine Street, University Area',
        'University Housing Corp',
        100,
        'WiFi, Gym, Laundry, Study Rooms',
        'Modern hostel for university students with excellent facilities',
        @warden1_id
    ),
    (
        'Lakeside Residency',
        '101 Lake Road, Campus View',
        'Lake Property Management',
        80,
        'WiFi, Swimming Pool, Cafeteria, Library',
        'Peaceful hostel with beautiful lake view',
        @warden2_id
    );
-- Get the generated UUIDs for hostels
SET @hostel1_id = (
        SELECT hostel_id
        FROM Hostels
        WHERE hostel_name = 'Sunrise Hostel'
    );
SET @hostel2_id = (
        SELECT hostel_id
        FROM Hostels
        WHERE hostel_name = 'Lakeside Residency'
    );
-- Insert Residents
INSERT INTO Residents (
        resident_id,
        hostel_id,
        phone_number,
        room_number,
        monthly_rent,
        status
    )
VALUES (
        @resident1_id,
        @hostel1_id,
        '+1122334455',
        'A101',
        2000.00,
        'active'
    ),
    (
        @resident2_id,
        @hostel1_id,
        '+2233445566',
        'A102',
        2000.00,
        'active'
    ),
    (
        @resident3_id,
        @hostel1_id,
        '+3344556677',
        'B201',
        2200.00,
        'active'
    ),
    (
        @resident4_id,
        @hostel1_id,
        '+4455667788',
        'B202',
        2200.00,
        'active'
    ),
    (
        @resident5_id,
        @hostel2_id,
        '+5566778899',
        'C101',
        1800.00,
        'active'
    ),
    (
        @resident6_id,
        @hostel2_id,
        '+6677889900',
        'C102',
        1800.00,
        'inactive'
    ),
    (
        @resident7_id,
        @hostel2_id,
        '+7788990011',
        'D201',
        2100.00,
        'active'
    ),
    (
        @resident8_id,
        @hostel2_id,
        '+8899001122',
        'D202',
        2100.00,
        'active'
    );
-- Insert Maintenance records
INSERT INTO Maintenance (
        maintanance_id,
        hostel_id,
        description,
        amount,
        status,
        date_of_payment
    )
VALUES (
        UUID(),
        @hostel1_id,
        'Plumbing repairs in Block A',
        1500.00,
        'resolved',
        '2024-01-15 10:30:00'
    ),
    (
        UUID(),
        @hostel1_id,
        'Electrical wiring maintenance',
        2000.00,
        'pending',
        '2024-03-05 14:45:00'
    ),
    (
        UUID(),
        @hostel2_id,
        'Roof leakage repair',
        3000.00,
        'resolved',
        '2024-02-20 09:15:00'
    ),
    (
        UUID(),
        @hostel2_id,
        'HVAC system servicing',
        2500.00,
        'pending',
        '2024-03-18 11:20:00'
    );
-- Insert Payments
INSERT INTO Payments (
        payment_id,
        resident_id,
        hostel_id,
        amount,
        date_of_payment
    )
VALUES (
        UUID(),
        @resident1_id,
        @hostel1_id,
        2000.00,
        '2024-01-05 09:00:00'
    ),
    (
        UUID(),
        @resident1_id,
        @hostel1_id,
        2000.00,
        '2024-02-05 09:30:00'
    ),
    (
        UUID(),
        @resident1_id,
        @hostel1_id,
        2000.00,
        '2024-03-05 10:15:00'
    ),
    (
        UUID(),
        @resident2_id,
        @hostel1_id,
        2000.00,
        '2024-01-06 11:45:00'
    ),
    (
        UUID(),
        @resident2_id,
        @hostel1_id,
        2000.00,
        '2024-02-06 10:30:00'
    ),
    (
        UUID(),
        @resident5_id,
        @hostel2_id,
        1800.00,
        '2024-01-04 14:20:00'
    ),
    (
        UUID(),
        @resident5_id,
        @hostel2_id,
        1800.00,
        '2024-02-04 15:10:00'
    ),
    (
        UUID(),
        @resident7_id,
        @hostel2_id,
        2100.00,
        '2024-01-08 16:45:00'
    ),
    (
        UUID(),
        @resident7_id,
        @hostel2_id,
        2100.00,
        '2024-02-08 16:30:00'
    );
-- Insert Complaints
INSERT INTO Complaints (
        complaint_id,
        resident_id,
        hostel_id,
        description,
        status
    )
VALUES (
        UUID(),
        @resident1_id,
        @hostel1_id,
        'Hot water not working in bathroom',
        'resolved'
    ),
    (
        UUID(),
        @resident2_id,
        @hostel1_id,
        'Window broken in room A102',
        'pending'
    ),
    (
        UUID(),
        @resident3_id,
        @hostel1_id,
        'Excessive noise from neighboring room',
        'pending'
    ),
    (
        UUID(),
        @resident5_id,
        @hostel2_id,
        'Leaking ceiling in rainy weather',
        'resolved'
    ),
    (
        UUID(),
        @resident7_id,
        @hostel2_id,
        'WiFi connectivity issues in Block D',
        'pending'
    );
-- Insert Feedbacks
INSERT INTO Feedbacks (feedback_id, user_id, feedback)
VALUES (
        UUID(),
        @resident1_id,
        'Great facilities and responsive maintenance team'
    ),
    (
        UUID(),
        @resident4_id,
        'The study rooms are very helpful for exam preparation'
    ),
    (
        UUID(),
        @resident5_id,
        'The hostel management has been very supportive'
    ),
    (
        UUID(),
        @resident6_id,
        'Need more variety in cafeteria menu'
    ),
    (
        UUID(),
        @warden1_id,
        'Suggestions for improving security systems in the hostel'
    );
-- Insert Announcements
INSERT INTO Announcements (announcement_id, hostel_id, announcement)
VALUES (
        UUID(),
        @hostel1_id,
        'Scheduled maintenance of water supply on Sunday from 10 AM to 2 PM'
    ),
    (
        UUID(),
        @hostel1_id,
        'Monthly floor meeting on Friday at 6 PM in the common room'
    ),
    (
        UUID(),
        @hostel1_id,
        'New gym equipment installed, training session on Saturday at 4 PM'
    ),
    (
        UUID(),
        @hostel2_id,
        'WiFi upgrade scheduled for next week, temporary disruptions expected'
    ),
    (
        UUID(),
        @hostel2_id,
        'Fire drill practice on Tuesday at 3 PM, all residents must participate'
    );