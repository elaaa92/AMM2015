create database OlympiaDB;
grant all on OlympiaDB. to 'pauElisa'@'localhost';
use OlympiaDB;
create user 'pauElisa'@'localhost' identified by 'pettirosso2204';
create table utenti (id VARCHAR(15), password VARCHAR(10), conto DOUBLE, tipologia VARCHAR (10));
create table articoli (id SERIAL, venditore VARCHAR(15), categoria VARCHAR(15), nome VARCHAR(20), prezzo DOUBLE, descrizione VARCHAR(500), disponibili INT, immagine VARCHAR(300));
create table acquisti (cliente VARCHAR(15), articolo SERIAL, quantita INT);

alter table articoli add primary key (id);
alter table utenti add primary key (id);
alter table acquisti add primary key (cliente, articolo);

alter table articoli add foreign key venditori_fk (venditore) references utenti(id) on delete cascade on update cascade;
alter table acquisti add foreign key clienti_fk (cliente) references utenti(id) on delete cascade on update cascade;
alter table acquisti add foreign key articoli_fk (articolo) references articoli(id) on delete cascade on update cascade;

insert into utenti (id, password, conto, tipologia) values ('Nike', '1234', '5000', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('Converse', '5678', '20', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('Reebook', '9101112', '0', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('Burton', 'abcd', '10000', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('MTB', 'efgh', '25800', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('Adidas', 'ilmn', '43510', 'venditore');
insert into utenti (id, password, conto, tipologia) values ('Sportswear', 'opqr', '200', 'venditore');

insert into utenti (id, password, conto, tipologia) values ('marco', '1234', '500', 'cliente');
insert into utenti (id, password, conto, tipologia) values ('giovanni', '5678', '30', 'cliente');
insert into utenti (id, password, conto, tipologia) values ('maria', '9101112', '0', 'cliente');
insert into utenti (id, password, conto, tipologia) values ('pamela', 'abcd', '180', 'cliente');

insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Nike', 'Corsa', 'Scarpe Nike', 60, 'Belle scarpe', 10, '../../Immagini/scarpenike.png');
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Converse', 'Casual', 'Scarpe Converse', 40, 'Belle scarpe', 5, '../../Immagini/scarpeconverse.png');
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Nike', 'Sport invernali', 'Guanti Nike', 20, 'Bei guanti', 2, '../../Immagini/guantinike.png');
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Reebook', "Corsa", "Scarpe Reebok", 30, "Belle scarpe", 30, "../../Immagini/scarpereebok.png");
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Burton', 'Surf', 'Tavola da surf', 500, 'Bella tavola', 100, "../../Immagini/tavoladasurf.png");
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'MTB',"Ciclismo", "Mountain bike", 230, "Bella bici", 8, "../../Immagini/mountainbike.png");
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Burton', 'Sport invernali', 'Giacca da snowboard', 40, 'Bella giacca', 3, '../../Immagini/giaccasnowboard.png');
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Adidas', 'Sport invernali', 'Guanti Adidas', 20, 'Bei guanti', 13, '../../Immagini/guantiadidas.png');
insert into articoli (id, venditore, categoria, nome, prezzo, descrizione, disponibili, immagine) values (default, 'Sportswear', 'Abbigliamento', 'Canottiera', 30, 'Bella canottiera', 50, '../../Immagini/canottiera.png');