# Insert Statements
# Templates!

Insert into production_company (id, name) values (1, "Bavaria Filmstudios");
Insert into production_company (id, name) values (2, "Great American Films");
Insert into production_company (id, name) values (3, "Touchstones Pictures");
Insert into production_company (id, name) values (4, "Warner Brothers Pictures");

Insert into film (id, title, release_date, production_company_id) values (3000, "Dirty Dancing", STR_TO_DATE('21.08.1987', '%d.%m.%Y'), 2);
Insert into film (id, title, release_date, production_company_id) values (3001, "Sister Act", STR_TO_DATE('29.05.1992', '%d.%m.%Y'), 3);
Insert into film (id, title, release_date, production_company_id) values (3002, "Harry Potter u. der Stein der Weisen", STR_TO_DATE('23.11.2001 ', '%d.%m.%Y'), 4);
Insert into film (id, title, release_date, production_company_id) values (3003, "Casanova", STR_TO_DATE('9.02.2006', '%d.%m.%Y'), 3);
Insert into film (id, title, release_date, production_company_id) values (3004, "Die unendliche Geschichte", STR_TO_DATE('20.05.1984', '%d.%m.%Y'), 1);
Insert into film (id, title, release_date, production_company_id) values (3005, "Die Welle", STR_TO_DATE('13.03.2008', '%d.%m.%Y'), 1);
Insert into film (id, title, release_date, production_company_id) values (3006, "Krieg in Chinatown", STR_TO_DATE('25.09.1987', '%d.%m.%Y'), 2);
Insert into film (id, title, release_date, production_company_id) values (3007, "I Am Legend", STR_TO_DATE('10.01.2008', '%d.%m.%Y'), 4);
Insert into film (id, title, release_date, production_company_id) values (3008, "Dirty Transcendence", STR_TO_DATE('18.04.2014', '%d.%m.%Y'), 4);

insert into country (id, name) values (1, "Austria");
insert into country (id, name) values (2, "Germany");

insert into actors (id, first_name, last_name, country_id) values (1, "Leonardo", "DiCaprio", 1);
insert into actors (id, first_name, last_name, country_id) values (2, "Will", "Smith", 1);
insert into actors (id, first_name, last_name, country_id) values (3, "Brad", "Pitt", 2);
insert into actors (id, first_name, last_name, country_id) values (4, "Johnny", "Depp", 2);

insert into film_actors (film_id, actors_id) value (3000, 1); 
insert into film_actors (film_id, actors_id) value (3001, 2); 
insert into film_actors (film_id, actors_id) value (3002, 3); 
insert into film_actors (film_id, actors_id) value (3003, 4); 
insert into film_actors (film_id, actors_id) value (3004, 1); 
insert into film_actors (film_id, actors_id) value (3005, 2); 
insert into film_actors (film_id, actors_id) value (3006, 3); 
insert into film_actors (film_id, actors_id) value (3007, 4); 
insert into film_actors (film_id, actors_id) value (3008, 1); 

# Stored procecdures for nicer db calls in php
# Examples

DELIMITER //
create procedure SearchByProdCompany(IN searchTerm VARCHAR(255))
BEGIN
select film.title as film_title, film.release_date, production_company.name as prod_company from film
inner join production_company on film.production_company_id = production_company.id where production_company.name like concat('%', searchTerm, '%')
order by film.release_date asc;
END//

call SearchByProdCompany("t");

DELIMITER //
create procedure SearchActors(IN searchTerm VARCHAR(255))
BEGIN
select film.title, film.release_date, actors.first_name, actors.last_name from film 
inner join film_actors on (film.id = film_actors.film_id) inner join actors on (film_actors.actors_id = actors.id) 
where actors.last_name like concat('%', searchTerm, '%')
order by film.release_date asc;
END//

call SearchByProdCompany("t");
call SearchActors("a");