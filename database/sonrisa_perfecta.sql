CREATE DATABASE IF NOT EXISTS sonrisa_perfecta CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sonrisa_perfecta;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(120) NOT NULL,
 username VARCHAR(60) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('admin','recepcion') NOT NULL DEFAULT 'recepcion',
 active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE patients (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 document VARCHAR(20) NULL,
 birth_date DATE NULL,
 gender ENUM('Masculino','Femenino','Otro') NULL,
 phone VARCHAR(30) NULL,
 email VARCHAR(120) NULL,
 address VARCHAR(220) NULL,
 notes TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY uq_patient_document(document)
) ENGINE=InnoDB;

CREATE TABLE dentists (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 document VARCHAR(20) NULL,
 specialty VARCHAR(100) NOT NULL,
 phone VARCHAR(30) NULL,
 email VARCHAR(120) NULL,
 license_number VARCHAR(50) NULL,
 active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE services (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 description TEXT NULL,
 price DECIMAL(10,2) NOT NULL DEFAULT 0,
 duration_minutes SMALLINT UNSIGNED NOT NULL DEFAULT 30,
 active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE appointments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 patient_id INT NOT NULL,
 dentist_id INT NOT NULL,
 service_id INT NULL,
 appointment_date DATE NOT NULL,
 appointment_time TIME NOT NULL,
 status ENUM('Pendiente','Confirmada','Atendida','Cancelada') NOT NULL DEFAULT 'Pendiente',
 reason TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_appointment_patient FOREIGN KEY(patient_id) REFERENCES patients(id) ON DELETE RESTRICT,
 CONSTRAINT fk_appointment_dentist FOREIGN KEY(dentist_id) REFERENCES dentists(id) ON DELETE RESTRICT,
 CONSTRAINT fk_appointment_service FOREIGN KEY(service_id) REFERENCES services(id) ON DELETE SET NULL,
 INDEX idx_appointment_date(appointment_date)
) ENGINE=InnoDB;

CREATE TABLE diagnoses (
 id INT AUTO_INCREMENT PRIMARY KEY,
 patient_id INT NOT NULL,
 dentist_id INT NOT NULL,
 appointment_id INT NULL,
 diagnosis_date DATE NOT NULL,
 description TEXT NOT NULL,
 observations TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_diagnosis_patient FOREIGN KEY(patient_id) REFERENCES patients(id) ON DELETE RESTRICT,
 CONSTRAINT fk_diagnosis_dentist FOREIGN KEY(dentist_id) REFERENCES dentists(id) ON DELETE RESTRICT,
 CONSTRAINT fk_diagnosis_appointment FOREIGN KEY(appointment_id) REFERENCES appointments(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE treatments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 patient_id INT NOT NULL,
 dentist_id INT NOT NULL,
 service_id INT NULL,
 diagnosis_id INT NULL,
 treatment_date DATE NOT NULL,
 description TEXT NOT NULL,
 cost DECIMAL(10,2) NOT NULL DEFAULT 0,
 status ENUM('Planificado','En proceso','Completado','Cancelado') NOT NULL DEFAULT 'Planificado',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_treatment_patient FOREIGN KEY(patient_id) REFERENCES patients(id) ON DELETE RESTRICT,
 CONSTRAINT fk_treatment_dentist FOREIGN KEY(dentist_id) REFERENCES dentists(id) ON DELETE RESTRICT,
 CONSTRAINT fk_treatment_service FOREIGN KEY(service_id) REFERENCES services(id) ON DELETE SET NULL,
 CONSTRAINT fk_treatment_diagnosis FOREIGN KEY(diagnosis_id) REFERENCES diagnoses(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE payments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 patient_id INT NOT NULL,
 appointment_id INT NULL,
 payment_date DATE NOT NULL,
 amount DECIMAL(10,2) NOT NULL,
 method ENUM('Efectivo','Tarjeta de crédito','Tarjeta de débito','Yape') NOT NULL,
 status ENUM('Pagado','Pendiente','Anulado') NOT NULL DEFAULT 'Pagado',
 reference VARCHAR(100) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_payment_patient FOREIGN KEY(patient_id) REFERENCES patients(id) ON DELETE RESTRICT,
 CONSTRAINT fk_payment_appointment FOREIGN KEY(appointment_id) REFERENCES appointments(id) ON DELETE SET NULL,
 INDEX idx_payment_date(payment_date)
) ENGINE=InnoDB;

-- El primer usuario se crea desde register.php para generar un hash seguro.
