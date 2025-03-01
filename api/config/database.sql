-- Table: users
CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(255),
    gender VARCHAR(20),
    profileImage VARCHAR(255),
    birthDate DATE,
    address VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);

-- Insert data into users table
INSERT INTO users (username, name, mobile, email, gender, profileImage, birthDate, address, password, role) VALUES
('john_doe', 'John Doe', '2221234', 'john@example.com', 'Male', '/uploads/rotated_left.jpg', '1990-01-01', 'De Guzman Building, 846 Henson, Pampanga', MD5('12345678'), 'pet owner'),
('jane_doe', 'Jane Doe', '1111234', 'jane@example.com', 'Female', '/uploads/carlottaimg.jpg', '1992-02-02', '55 Kitanlad Street 1100, Quezon City', MD5('12345678'), 'pet owner');

-- Table: petOwners
CREATE TABLE petOwners (
    petOwnerId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    petId INT,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (petId) REFERENCES pets(petId)
);

-- Table: pets
CREATE TABLE pets (
    petId INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    breed VARCHAR(100),
    age INT,
    petOwnerId INT,
    type VARCHAR(100),
    registrationDate DATE,
    registrationNumber VARCHAR(100),
    isRegistered BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (petOwnerId) REFERENCES petOwners(petOwnerId)
);

-- Insert data into petOwners table
INSERT INTO petOwners (userId, petId) VALUES
(1, 1),
(2, 2);

-- Table: veterinarians
CREATE TABLE veterinarians (
    vetId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    name VARCHAR(100) NOT NULL,
    clinicName VARCHAR(255) NOT NULL,
    contactNumber VARCHAR(20),
    licenseNumber VARCHAR(50) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- Table: vaccinationRecords
CREATE TABLE vaccinationRecords (
    vaccinationId INT AUTO_INCREMENT PRIMARY KEY,
    petId INT,
    vaccinationDate DATE,
    vaccinationType VARCHAR(100),
    vaccinatingVeterinarianId INT,
    FOREIGN KEY (petId) REFERENCES pets(petId),
    FOREIGN KEY (vaccinatingVeterinarianId) REFERENCES veterinarians(vetId)
);

-- Table: impoundingRecords
CREATE TABLE impoundingRecords (
    impoundId INT AUTO_INCREMENT PRIMARY KEY,
    petId INT,
    impoundDate DATE,
    impoundLocation VARCHAR(255),
    foundLocation VARCHAR(255),
    impoundReason VARCHAR(255),
    releaseDate DATE,
    releasedTo VARCHAR(100),
    FOREIGN KEY (petId) REFERENCES pets(petId)
);

-- Table: feedback
CREATE TABLE feedback (
    feedbackId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    feedbackDate DATETIME NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- Table: lgu
CREATE TABLE lgu (
    lguId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    name VARCHAR(100) NOT NULL,
    contactNumber VARCHAR(20),
    email VARCHAR(255),
    position VARCHAR(100),
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- Table: incidents
CREATE TABLE incidents (
    incidentId INT AUTO_INCREMENT PRIMARY KEY,
    petId INT,
    incidentDateTime DATETIME,
    incidentLocation VARCHAR(255),
    description TEXT,
    FOREIGN KEY (petId) REFERENCES pets(petId)
);

-- Table: warrants
CREATE TABLE warrants (
    warrantId INT AUTO_INCREMENT PRIMARY KEY,
    petId INT,
    issuedDateTime DATETIME,
    issuingAuthorityId INT,
    FOREIGN KEY (petId) REFERENCES pets(petId),
    FOREIGN KEY (issuingAuthorityId) REFERENCES users(userId)
);

-- Table: registrationForms
CREATE TABLE registrationForms (
    formId INT AUTO_INCREMENT PRIMARY KEY,
    ownerLastName VARCHAR(100) NOT NULL,
    ownerFirstName VARCHAR(100) NOT NULL,
    ownerMiddleName VARCHAR(100),
    telephoneNumber VARCHAR(20),
    mobileNumber VARCHAR(20),
    birthday DATE,
    emailAddress VARCHAR(255),
    homeAddress VARCHAR(255),
    petName VARCHAR(100),
    breed VARCHAR(100),
    weight DECIMAL(10, 2),
    color VARCHAR(50),
    antiRabiesVaccinationDate DATE,
    expiryDate DATE,
    veterinarianClinic VARCHAR(255),
    veterinaryClinicAddress VARCHAR(255),
    veterinarianName VARCHAR(100),
    vetAge INT,
    vetGender VARCHAR(10),
    vetContactInfo VARCHAR(50),
    petAge INT,
    petGender VARCHAR(10),
    petBirthdate DATE,
    distinguishingMarks TEXT,
    petOwnerSignature VARCHAR(255),
    dateSigned DATE
);

-- Table: notifications
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    link VARCHAR(100) NOT NULL,
    notificationMessage VARCHAR(100) NOT NULL,
    dateCreated DATE
);

-- Table: authTokens
CREATE TABLE authTokens (
    tokenId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    authToken VARCHAR(255) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(userId)
);