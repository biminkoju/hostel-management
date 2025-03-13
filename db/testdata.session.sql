--@block
-- Inserting residents
INSERT INTO Users (username, email, password, account_type)
VALUES (
        'JohnDoe',
        'john.doe@example.com',
        'securepassword',
        'resident'
    ),
    (
        'JaneSmith',
        'jane.smith@example.com',
        'password123',
        'resident'
    ),
    (
        'MikeJohnson',
        'mike.johnson@example.com',
        'password456',
        'resident'
    ),
    (
        'EmilyDavis',
        'emily.davis@example.com',
        'mypassword789',
        'resident'
    ),
    (
        'WardenChris',
        'warden.chris@example.com',
        'wardenpassword',
        'warden'
    ),
    (
        'WardenAlex',
        'warden.alex@example.com',
        'adminpassword',
        'warden'
    );
-- Inserting wardens (Note that these are already added as residents too, with account_type 'warden')
INSERT INTO Users (username, email, password, account_type)
VALUES (
        'WardenSam',
        'warden.sam@example.com',
        'adminpassword123',
        'warden'
    );
-- Inserting hostels
INSERT INTO Hostels (hostel_name, address, owner, capacity, amenities)
VALUES (
        'Sunny Side Hostel',
        '123 Sunshine Blvd, Cityville',
        'Alice Johnson',
        100,
        'Wi-Fi, Laundry, Gym, 24/7 Security'
    ),
    (
        'Green Garden Hostel',
        '456 Green St, Townsville',
        'Bob Smith',
        150,
        'Wi-Fi, Kitchen, Lounge Area, Laundry'
    ),
    (
        'Downtown Hostel',
        '789 Main St, Metropolis',
        'Charlie Brown',
        75,
        'Wi-Fi, Parking, Air Conditioning'
    ),
    (
        'Urban Heights Hostel',
        '101 Urban Rd, Citytown',
        'David White',
        200,
        'Wi-Fi, Gym, Cafeteria, Study Rooms'
    );
-- Inserting wardens and assigning them to hostels
INSERT INTO Wardens (
        warden_id,
        hostel_id,
        phone_number,
        monthly_salary
    )
VALUES (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'WardenChris'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Sunny Side Hostel'
        ),
        1234567890,
        4000
    ),
    (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'WardenAlex'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Green Garden Hostel'
        ),
        2345678901,
        4200
    ),
    (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'WardenSam'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Downtown Hostel'
        ),
        3456789012,
        4500
    );
-- Inserting residents and assigning them to hostels
INSERT INTO Residents (
        resident_id,
        hostel_id,
        phone_number,
        room_number,
        monthly_rent,
        status
    )
VALUES (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'JohnDoe'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Sunny Side Hostel'
        ),
        '9876543210',
        'A101',
        3000,
        'active'
    ),
    (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'JaneSmith'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Green Garden Hostel'
        ),
        '8765432109',
        'B203',
        3200,
        'active'
    ),
    (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'MikeJohnson'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Downtown Hostel'
        ),
        '7654321098',
        'C305',
        3300,
        'inactive'
    ),
    (
        (
            SELECT user_id
            FROM Users
            WHERE username = 'EmilyDavis'
        ),
        (
            SELECT hostel_id
            FROM Hostels
            WHERE hostel_name = 'Urban Heights Hostel'
        ),
        '6543210987',
        'D402',
        3500,
        'active'
    );