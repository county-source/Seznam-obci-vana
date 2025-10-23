DROP TABLE IF EXISTS municipalities;
DROP TABLE IF EXISTS districts;
DROP TABLE IF EXISTS regions;

CREATE TABLE regions (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL
);

CREATE TABLE districts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        region_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        FOREIGN KEY (region_id) REFERENCES regions(id)
);

CREATE TABLE municipalities (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        district_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        FOREIGN KEY (district_id) REFERENCES districts(id)
);

INSERT INTO regions (name) VALUES
        ('Hlavní město Praha'),
        ('Středočeský kraj'),
        ('Jihomoravský kraj');

INSERT INTO districts (region_id, name) VALUES
        (1, 'Praha'),
        (2, 'Praha-východ'),
        (2, 'Příbram'),
        (3, 'Brno-město'),
        (3, 'Znojmo');

INSERT INTO municipalities (district_id, name) VALUES
        (1, 'Praha 1'),
        (1, 'Praha 2'),
        (1, 'Praha 3'),
        (2, 'Brandýs nad Labem-Stará Boleslav'),
        (2, 'Čelákovice'),
        (2, 'Říčany'),
        (3, 'Příbram'),
        (3, 'Dobříš'),
        (3, 'Sedlčany'),
        (4, 'Brno'),
        (4, 'Brno-Bosonohy'),
        (5, 'Znojmo'),
        (5, 'Hrušovany nad Jevišovkou'),
        (5, 'Vranov nad Dyjí');
