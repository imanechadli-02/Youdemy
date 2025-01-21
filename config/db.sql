CREATE DATABASE Youdemy;
use Youdemy;

CREATE Table Users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role ENUM('admin', 'etudiant', 'enseignant') DEFAULT 'etudiant'
);

ALTER Table users
ADD COLUMN  status ENUM('active', 'suspendue') DEFAULT 'active';

CREATE Table Admin(
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

DROP table enseignants;
CREATE Table Enseignants(
    enseignant_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status ENUM('active', 'suspendue') DEFAULT 'active',
    validation BOOLEAN DEFAULT FALSE,
    password VARCHAR(100) NOT NULL
);

CREATE table Etudiant(
    etudiant_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE Table Cours(
    cours_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(100) NOT NULL,
    tag_id INT NOT NULL,
    categorie_id INT NOT NULL,
    enseignant_id INT NOT NULL,
    creat_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enseignant_id) REFERENCES Enseignants(enseignant_id)
);

ALTER Table Cours
ADD COLUMN content_text TEXT DEFAULT null;
ALTER Table Cours
ADD COLUMN content_video VARCHAR(255) DEFAULT NULL;

CREATE table Categorie(
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE Table Tags(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE Table Cours_tags(
    cours_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id),
    PRIMARY KEY (cours_id, tag_id)
);

CREATE Table Cours_etudiant(
    cours_id INT NOT NULL,
    etudiant_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (etudiant_id) REFERENCES Etudiant(etudiant_id),
    PRIMARY KEY (cours_id, etudiant_id)
);



CREATE table mesCourses(
    lib_id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT NOT NULL,
    etudiant_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (etudiant_id) REFERENCES Etudiant(etudiant_id)
);