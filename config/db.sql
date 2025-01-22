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

-- CREATE Table Admin(
--     admin_id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(100) NOT NULL,
--     email VARCHAR(100) NOT NULL,
--     password VARCHAR(100) NOT NULL
-- );


-- DROP table enseignants;
-- CREATE Table Enseignants(
--     enseignant_id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(100) NOT NULL,
--     email VARCHAR(100) NOT NULL,
--     status ENUM('active', 'suspendue') DEFAULT 'active',
--     validation BOOLEAN DEFAULT FALSE,
--     password VARCHAR(100) NOT NULL
-- );

-- CREATE table Etudiant(
--     etudiant_id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(100) NOT NULL,
--     email VARCHAR(100) NOT NULL,
--     password VARCHAR(100) NOT NULL
-- );

CREATE Table Cours(
    cours_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(100) NOT NULL,
    content_text TEXT DEFAULT NULL,
    content_video VARCHAR(255) DEFAULT NULL,
    tag_id INT NOT NULL,
    categorie_id INT NOT NULL,
    user_id INT NOT NULL,
    creat_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
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

DROP TABLE cours;

ALTER table cours
MODIFY COLUMN type ENUM('text', 'video') DEFAULT 'text';


CREATE table Categorie(
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE Table Tags(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

INSERT INTO Tags (nom) VALUES ('Mathematics');
INSERT INTO Tags (nom) VALUES ('Science');
INSERT INTO Tags (nom) VALUES ('Technology');
INSERT INTO Tags (nom) VALUES ('Programming');
INSERT INTO Tags (nom) VALUES ('History');
INSERT INTO Tags (nom) VALUES ('Literature');

CREATE Table Cours_tags(
    cours_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id),
    PRIMARY KEY (cours_id, tag_id)
);
DROP Table Cours_tags;

CREATE Table Cours_etudiant(
    cours_id INT NOT NULL,
    etudiant_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (etudiant_id) REFERENCES Etudiant(etudiant_id),
    PRIMARY KEY (cours_id, etudiant_id)
);
DROP Table cours_etudiant;



CREATE table mesCourses(
    lib_id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(cours_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
DROP Table mescourses;

SELECT *
                      FROM cours 
                      JOIN categorie ON cours.categorie_id = categorie.categorie_id




SELECT * FROM cours WHERE cours_id = 9;

select * from cours AS c
JOIN categorie as ca on c.categorie_id = ca.categorie_id;

SELECT * FROM cours 
                  join categorie on cours.categorie_id = categorie.categorie_id
                  join tags on cours.tag_id = tags.tag_id
                  join users on cours.user_id = users.user_id




SELECT 
    cours.cours_id, 
    cours.titre, 
    cours.description, 
    cours.image, 
    users.username, 
    Categorie.nom AS categorie_name,
    COUNT(mesCourses.lib_id) AS total_courses
FROM 
    mesCourses 
JOIN 
    cours ON mesCourses.cours_id = cours.cours_id 
JOIN 
    users ON mesCourses.user_id = users.user_id 
JOIN 
    Categorie ON cours.categorie_id = Categorie.categorie_id
GROUP BY 
    cours.cours_id, cours.titre, cours.description, cours.image, users.username, Categorie.nom;


SELECT 
    Categorie.nom AS categorie_name,
    cours.cours_id,
    cours.titre,
    cours.description,
    cours.image,
    users.username AS course_instructor
FROM 
    Categorie
JOIN 
    cours ON Categorie.categorie_id = cours.categorie_id
JOIN 
    users ON cours.user_id = users.user_id
ORDER BY 
    Categorie.nom, cours.titre;
