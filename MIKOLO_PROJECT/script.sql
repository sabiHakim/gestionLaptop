create  table  Magasin(
    id serial primary key,
    nom varchar(25),
    mdp varchar(25)
);
insert into  Magasin(nom, mdp) values ('magasin','magasin');

create  table  marque(
    id serial primary key ,
    nom varchar(25)
);
INSERT INTO marque (nom) VALUES
                             ('Apple'),
                             ('Dell'),
                             ('HP'),
                             ('Lenovo'),
                             ('Asus'),
                             ('Acer'),
                             ('MSI'),
                             ('Samsung');
 create  table  processeur(
   id serial primary key ,
     nom varchar(25)
 );
INSERT INTO processeur (nom) VALUES
                                 ('Intel Core i3'),
                                 ('Intel Core i5'),
                                 ('Intel Core i7'),
                                 ('Intel Core i9'),
                                 ('AMD Ryzen 3'),
                                 ('AMD Ryzen 5'),
                                 ('AMD Ryzen 7'),
                                 ('AMD Ryzen 9'),
                                 ('Apple M1'),
                                 ('Apple M1 Pro'),
                                 ('Apple M1 Max'),
                                 ('Apple M2'),
                                 ('Intel Pentium'),
                                 ('Intel Celeron'),
                                 ('AMD Athlon');
CREATE TABLE laptops (
                         id SERIAL PRIMARY KEY,
                         marque_id INT REFERENCES marque(id),
                         modele VARCHAR(100),
                         processeur_id INT REFERENCES processeur(id),
                         ram VARCHAR(50),
                         ecran VARCHAR(50),
                         disque_dur VARCHAR(100),
                         prix double precision
);
CREATE VIEW v_laptop AS
SELECT
    laptops.id,
    marque.nom AS marque,
    laptops.modele,
    processeur.nom AS processeur,
    laptops.ram,
    laptops.ecran,
    laptops.disque_dur
FROM
    laptops
        JOIN
    marque ON laptops.marque_id = marque.id
        JOIN
    processeur ON laptops.processeur_id = processeur.id;

CREATE TABLE pv (
                    id SERIAL PRIMARY KEY,
                    nom VARCHAR(25),
                    latitude DECIMAL(9, 6), -- Latitude avec 9 chiffres au total, 6 après la virgule
                    longitude DECIMAL(9, 6), -- Longitude avec 9 chiffres au total, 6 après la virgule
                    nbrUser INT
);
insert  into  pv(nom, latitude, longitude, nbruser) values ('besarety',-18.90188838679937,47.53661919873322,5);
insert  into  pv(nom, latitude, longitude, nbruser) values ('parking',-18.907383106535264, 47.50877043745176,5);
insert  into  pv(nom, latitude, longitude, nbruser) values ('solomaso',-18.898402386142912, 47.53068557263014,5);
insert  into  pv(nom, latitude, longitude, nbruser) values ('andoram',-18.977716814554448, 47.53284052420859,5);
-- -18.90188838679937, 47.53661919873322   --besarety
-- -18.907383106535264, 47.50877043745176 --parking
-- -18.898402386142912, 47.53068557263014 --solomaso
-- -18.977716814554448, 47.53284052420859 --andoram

create  table  stockM(
    id serial primary key ,
    idLaptop int references  laptops(id),
    nbr int,
    dateAchat date
);
create  or replace view v_stock_lap as
        select idLaptop,sum(nbr)
        from stockM group by  idLaptop;

 create  table  stock_lap_pv(
     idpv int references  pv(id),
     idlap int references  laptops(id),
     nb int
 );

create  table  receptionlap(
    id serial primary key ,
    idpv int references  pv(id),
    idlap int references laptops(id),
    nbr int,
    date_reception date
);
create  table  vente(
    id serial primary key,
    idpv int references pv(id),
     idlap int references  laptops(id),
    nbr int,
    date_vente date
);
create  table perte(
    id serial primary key ,
    idpv int references pv(id),
    idlap int references  laptops(id),
    nbr int
)

create  or replace view v_stock_reception as
        select idpv,idlap,sum(nbr)
        from receptionlap group by  idpv,idlap;

CREATE VIEW v_stock_lap_pv AS
SELECT
    slp.idpv,
    slp.idlap,
    slp.nb,
    l.marque_id,
    l.modele,
    l.processeur_id,
    l.ram,
    l.ecran,
    l.disque_dur
FROM
    stock_lap_pv slp
        JOIN
    laptops l ON slp.idlap = l.id;
--
CREATE  or replace VIEW vue_ventes_laptops AS
SELECT
    v.id AS vente_id,
    v.idpv,
    v.nbr,
    v.date_vente,
    l.id AS laptop_id,
    l.marque_id,
    l.modele,
    l.processeur_id,
    l.ram,
    l.ecran,
    l.disque_dur,
    l.prix
FROM
    vente v
        JOIN
    laptops l ON v.idlap = l.id;

