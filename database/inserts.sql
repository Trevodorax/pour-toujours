-- PERSONNES

INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement,
    estAdmin
)
VALUES(
    'Paul Gaudeaux',
    'Paul',
    '2003/07/13',
    'H',
    'phvcgdx@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '75',
    1
);



INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement
)
VALUES(
    'Loriane Hilderal',
    'Milo',
    '2002/08/13',
    'A',
    'milo@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579785',
    '75'
);



INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement
)
VALUES(
    'Simon Damette',
    'Simon',
    '2003/09/13',
    'H',
    'sdamette.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '75'
);



INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement
)
VALUES(
    'Michel Ducoin',
    'Michel',
    '1995/04/13',
    'H',
    'mducoin@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '13'
);



INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement
)
VALUES(
    'Sandrine Porto',
    'Sandy',
    '1970/07/13',
    'F',
    'sporto@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '13'
);



INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement
)
VALUES(
    'Charles Galaga',
    'Carlos',
    '2011/07/13',
    'N',
    'cgalaga@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '13'
);

INSERT INTO PERSONNE(
    nomComplet,
    nomPrefere,
    date_naissance,
    genre,
    email,
    mot_de_passe,
    numero_tel,
    departement,
    estAdmin
)
VALUES(
    'Henri Gaudeaux',
    'Riton',
    '1998/09/20',
    'H',
    'hgaudeaux@gmail.com',
    '919e4acd7a1714cd19c7c7157ea417ebe85098e16e6c992deec765cef201c404a903ddfa67e1af51a2a091a9a5d8643e1214fd62f48ac56b4c7cd3f91cca7d3e',
    '0682579783',
    '75',
    1
);




-- PRESTATAIRES

INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'bagels co',
    '0154878526',
    'pro@hotmail.fr',
    'vendeur de bagels',
    'je vends des bagels',
    1
);



INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'wedding dresses SARL',
    '0854746351',
    'weddress@gmail.com',
    'tailleuse styliste',
    'je vous donnerai les meilleures robes pour votre mariage',
    2
);



INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'organisation mariages',
    '3630',
    'supermariage@gmail.com',
    'agent',
    'description',
    3
);



INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'mariages faciles SA',
    '0187879888',
    'marifa@gmail.com',
    'plein de trucs',
    "je fais ce qu'il faut pour votre mariage",
    4
);



INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'pommes & co',
    '0154545465',
    'padide@hotmail.fr',
    'padide',
    'aucune inspiration ici',
    5
);



INSERT INTO PRESTATAIRE(
    nomEntreprise,
    telPro,
    emailPro,
    metier,
    description,
    personne
)
VALUES(
    'entreprise SARL',
    '0821252217',
    'vrmrien@outlook.fr',
    'bahrienquoi',
    'vraiment je sais plus quoi écrire',
    6
);



-- SERVICES

-- nourriture

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'bouffe pas chère',
    'N',
    10,
    "Nourriture pas bonne, mais bon, fallait être riche c'est pas mon problème",
    1
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'repas classique',
    'N',
    20,
    'Un repas de qualité pour vous et vos invités',
    1
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Repas gastronomique',
    'N',
    50,
    'Notre chef cuisinier saura satisfaire les plus gourmets de cette Terre.',
    3
);

-- animation

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Clown stagiaire',
    'A',
    100,
    "Un clown pas super drôle, mais il fait ce qu'il peut",
    4
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Mariachis',
    'A',
    300,
    "D'excellents guitaristes qui sauront mettre l'ambiance",
    4
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Concert du roi de la pop',
    'A',
    2000,
    'Michael Jackson revit pour animer votre mariage',
    6
);



-- lieu

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'salle dess fêtes miteuse',
    'L',
    1000,
    'La mairie de Saint Gabin des Oies',
    5
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Restaurant',
    'L',
    3000,
    'Un restaurant sympa réservé pour vous (la nourriture est à vos frais)',
    5
);


INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Colisée',
    'L',
    5000,
    'Le colisée vous ouvre ses portes pour un moment magique',
    5
);


-- tenue

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'robes et costumes lowcost',
    'T',
    200,
    'Tous nos produits viennent de Leader Price directement',
    2
);

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'robes et costumes Sergio Cotturi',
    'T',
    500,
    "Qualité moyenne, mais ça fera l'affaire",
    4
);

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'Robes et costumes de sapeurs',
    'T',
    1000,
    "Nos sapeurs finement formés à l'art de la mode vous habilleront avec style et aise",
    2
);


-- photos

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'photographe en bac pro',
    'P',
    100,
    'Nelson viendra prendre vos photos comme il peut, il est gentil',
    4
);

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'photographe en début de carrière',
    'P',
    200,
    "Nous vous enverrons un photographe qui a fini ses études, c'est déjà ça",
    4
);

INSERT INTO SERVICE(
    nom,
    type,
    tarif,
    description,
    prestataire
)
VALUES(
    'photographe expérimenté',
    'P',
    300,
    "Vous regarderez encore ces photos en souriant d'ici 30 ans, un photographe de rêve",
    4
);

-- utilisateur
INSERT INTO UTILISATEUR (personne) VALUES (7);

-- commentaires
INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    5,
    1,
    1,
    1
);


INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    4,
    2,
    1,
    1
);


INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    4,
    3,
    1,
    1
);


INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    5,
    4,
    1,
    1
);

INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    4,
    4,
    2,
    1
);

INSERT INTO COMMENTAIRE (
    note,
    prestataire,
    utilisateur,
    valide
)
VALUES (
    5,
    4,
    2,
    1
);

