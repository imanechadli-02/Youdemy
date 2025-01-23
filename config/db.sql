CREATE DATABASE Youdemy;
use Youdemy;

CREATE Table Users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role ENUM('admin', 'etudiant', 'enseignant') DEFAULT 'etudiant',
    status ENUM('active', 'suspendue') DEFAULT 'active'
);




CREATE TABLE Cours (
    cours_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(100) NOT NULL,
    content_text TEXT DEFAULT NULL,
    content_video VARCHAR(255) DEFAULT NULL,
    type ENUM('text', 'video') DEFAULT 'text',
    categorie_id INT NOT NULL,
    user_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(categorie_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);


CREATE table Categorie(
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE Table Tags(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);


-- CREATE Table Cours_tags(
--     cours_id INT NOT NULL,
--     tag_id INT NOT NULL,
--     FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
--     FOREIGN KEY (tag_id) REFERENCES Tags(tag_id),
--     PRIMARY KEY (cours_id, tag_id)
-- );
DROP Table Cours_tags;

-- CREATE Table Cours_etudiant(
--     cours_id INT NOT NULL,
--     etudiant_id INT NOT NULL,
--     FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
--     FOREIGN KEY (etudiant_id) REFERENCES Etudiant(etudiant_id),
--     PRIMARY KEY (cours_id, etudiant_id)
-- );




CREATE table mesCourses(
    lib_id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


