<?php

use LDAP\Result;
function setup($con)
{
    $query = "CREATE TABLE IF NOT EXISTS Users (
    user_id CHAR(36) NOT NULL DEFAULT (UUID()),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    account_type ENUM('resident', 'warden') NOT NULL DEFAULT 'resident',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id)
);
--@block
CREATE TABLE IF NOT EXISTS Hostels(
    hostel_id CHAR(36) NOT NULL DEFAULT (UUID()),
    hostel_name varchar(255) NOT NULL,
    address varchar(255) not NULL,
    owner varchar(255) not null,
    capacity INT DEFAULT 0,
    amenities TEXT,
    date_of_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary KEY (hostel_id)
);
--@block
create table if not exists Wardens(
    warden_id char(36) not null,
    hostel_id char(36) not null,
    phone_number int(15) not null unique,
    monthly_salary decimal(10, 2) not null default(4000),
    foreign key (warden_id) REFERENCES Users(user_id),
    PRIMARY key (warden_id),
    foreign key (hostel_id) references Hostels(hostel_id)
);
--@block
create table if not exists Residents (
    resident_id char(36) not null,
    hostel_id char(36) not null,
    phone_number varchar(10) not null unique,
    room_number varchar(255) not null,
    monthly_rent decimal(10, 2) not null default(4000.00),
    status ENUM('active', 'inactive') not null default 'active',
    foreign key (resident_id) REFERENCES Users(user_id),
    PRIMARY key (resident_id),
    foreign key (hostel_id) references Hostels(hostel_id)
);";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "sucessfull";
    } else {
        echo "something went wrong";
    }

}
?>