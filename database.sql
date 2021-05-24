drop database if exists Parapharmacy;
create database Parapharmacy;
use Parapharmacy;

create table parafarmacia
(

	CodiceTracciabilita integer primary key,
	Nome varchar(30),
	NumeroFarmacisti INTEGER DEFAULT 0,
	Descrizione varchar(255)
	
) Engine = 'InnoDB';


create table casafarmaceutica
(

	PIVA BIGINT primary key,
	Nome varchar(50)
	
) Engine = 'InnoDB';


create table prodotto
(

	CodiceMinsan BIGINT primary key,
	IVA float,
	PrezzoNetto integer,
	Immagine varchar(255)
	
) Engine = 'InnoDB';


create table cliente
(

	CF VARCHAR(20) primary key,
	Nome varchar(50),
	Cognome varchar(50),
	Telefono varchar(50)

	
) Engine = 'InnoDB';


create table farmacista
(

	NumeroIscrizioneAlbo BIGINT primary key,
	Nome varchar(50),
	Cognome varchar(50)

	
) Engine = 'InnoDB';


create table programma_assistenza
(

	Id integer primary key,
	Citta varchar(30)
	
) Engine = 'InnoDB';


create table medicinale
(

	Prodotto BIGINT primary key,
	PrincipioAttivo varchar(50),
	Nome varchar(50),
	
	INDEX idxPr (Prodotto),
	
	FOREIGN KEY (Prodotto) REFERENCES prodotto(CodiceMinsan)

	
) Engine = 'InnoDB';


create table cosmesi
(

	Prodotto BIGINT primary key,
	TipoTrattamento varchar(50),
	
	INDEX idxPr2 (Prodotto),
	
	FOREIGN KEY (Prodotto) REFERENCES prodotto(CodiceMinsan)

	
) Engine = 'InnoDB';



create table contrattolavoro
(

	IdContratto integer primary key auto_increment,
	Tipo varchar(20),
	DataInizio date,
	DataFine date,
	Farmacista BIGINT,
	Parafarmacia integer,
	
	unique (DataInizio, Farmacista, Parafarmacia),
	
	INDEX idxFr (Farmacista),
	INDEX idxPr (Parafarmacia),
	
	FOREIGN KEY (Farmacista) REFERENCES farmacista(NumeroIscrizioneAlbo),
	FOREIGN KEY (Parafarmacia) REFERENCES parafarmacia(CodiceTracciabilita)

	
) Engine = 'InnoDB';


create table fornitura
(

	CodiceParafarmacia integer,
	PIVACasaFarmaceuitica BIGINT,
	CodiceProdotto BIGINT,
	
	PRIMARY KEY (CodiceParafarmacia, PIVACasaFarmaceuitica, CodiceProdotto),
	
	INDEX idxCP (CodiceParafarmacia),
	INDEX idxPICF (PIVACasaFarmaceuitica),
	INDEX idxCPr (CodiceProdotto),
	
	FOREIGN KEY (CodiceParafarmacia) REFERENCES parafarmacia(CodiceTracciabilita),
	FOREIGN KEY (PIVACasaFarmaceuitica) REFERENCES casafarmaceutica(PIVA),
	FOREIGN KEY (CodiceProdotto) REFERENCES prodotto(CodiceMinsan)

	
) Engine = 'InnoDB';



create table acquisto
(

	IdAcquisto integer primary key auto_increment,
	Prodotto BIGINT,
	DataAcquisto date,
	Cliente VARCHAR(20),
	Quantita integer,
	
	unique (Prodotto, DataAcquisto, Cliente),
	
	INDEX idxProd (Prodotto),
	INDEX idxCli (Cliente),
	
	FOREIGN KEY (Prodotto) REFERENCES prodotto(CodiceMinsan),
	FOREIGN KEY (Cliente) REFERENCES cliente(CF)

	
) Engine = 'InnoDB';



create table adesione
(

	Parafarmacia INTEGER,
	ProgrammaAssistenza INTEGER,
	
	unique (Parafarmacia, ProgrammaAssistenza),
	
	INDEX idxPara (Parafarmacia),
	INDEX idxPA (ProgrammaAssistenza),
	
	FOREIGN KEY (Parafarmacia) REFERENCES parafarmacia(CodiceTracciabilita),
	FOREIGN KEY (ProgrammaAssistenza) REFERENCES programma_assistenza(Id)
	
	
) Engine = 'InnoDB';

CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(16) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  surname varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email)
) ENGINE = 'InnoDB' AUTO_INCREMENT=3;




DELIMITER //
CREATE PROCEDURE trova_mediciniale (in principio_attivo VARCHAR(50))

BEGIN


select *
FROM medicinale M
where M.PrincipioAttivo = principio_attivo;


end //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE trova_farmacisti (in codice_parafarmacia integer)

BEGIN


select F.Nome AS Nome_Farmacista, F.Cognome as Cognome_Farmacista, CL.Tipo as Stato_Contratto
FROM parafarmacia P, contrattolavoro CL, farmacista F
where P.CodiceTracciabilita = CL.Parafarmacia AND CL.Farmacista = F.NumeroIscrizioneAlbo AND P.CodiceTracciabilita = codice_parafarmacia;


end //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE aggiungi_prodotto (in codice_prodotto BIGINT, in iva float, in prezzo_netto INTEGER)

BEGIN

insert into prodotto values 
(codice_prodotto, iva, prezzo_netto);


end //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE numero_farmacisti (in codice_parafarmacia integer,out n_farmacisti INTEGER)

BEGIN

SELECT P.NumeroFarmacisti into n_farmacisti
FROM parafarmacia P
WHERE P.CodiceTracciabilita = codice_parafarmacia;


end //
DELIMITER ;




DELIMITER //
CREATE TRIGGER aggiorno_num_farmacisti
after INSERT on contrattolavoro
for EACH ROW
BEGIN
		if exists (select * from parafarmacia P WHERE P.CodiceTracciabilita = NEW.Parafarmacia)
		then
			update parafarmacia set NumeroFarmacisti = (NumeroFarmacisti + 1)
			where CodiceTracciabilita = new.Parafarmacia;
		
		end if;

end //
DELIMITER ;

DELIMITER //
CREATE TRIGGER riduco_num_farmacisti
after INSERT on contrattolavoro
for EACH ROW
BEGIN
		if exists (select * from parafarmacia P WHERE P.CodiceTracciabilita = NEW.Parafarmacia and new.Tipo = "Passato")
		then
			update parafarmacia set NumeroFarmacisti = (NumeroFarmacisti - 1)
			where CodiceTracciabilita = new.Parafarmacia;
		
		end if;

end //
DELIMITER ;


DELIMITER //

create trigger businnes_rule
before insert on adesione
for each row
begin

			if (SELECT P.NumeroFarmacisti from parafarmacia P where P.CodiceTracciabilita = new.Parafarmacia) < 3
			THEN
				signal sqlstate '45000' set MESSAGE_TEXT = "La parafarmacia indicata non può aderire ad un Programma di assistenza sociale perché ha meno di 3 farmacisti";
				
			end if;


end //
DELIMITER ;


INSERT INTO parafarmacia (CodiceTracciabilita, Nome, NumeroFarmacisti, Descrizione) VALUES
(1379, 'Parafarmacia Italia', 0, 'Corso Italia 51 Catania 95124'),
(1925, 'Parafarmacia Europa', 0, 'Piazza Europa 12 Catania 95124'),
(2561, 'Parafarmacia Naxos', 0, 'Via Naxos 245 Giardini-Naxos 98035'),
(2725, 'Parafarmacia Nazionale', 0, 'Via Nazionale 21 Taormina 98039'),
(2764, 'Parafarmacia Monserrato', 0, 'Via Monserrato 23 Catania 95124'),
(3586, 'Parafarmacia Spadaro', 0, 'Corso Umberto 330 Bronte 95034'),
(3664, 'Parafarmacia Schiliro', 0, 'Via Alcide De Gasperi 34 Bronte 95034'),
(6460, 'Parafarmacia Ruvolo', 0, 'Via Consolare Valeria 1 Giardini-Naxos 98035'),
(7158, 'Parafarmacia Di Luca', 0, 'Via Pietralunga 33 Catania 95124'),
(9320, 'Parafarmacia Italia', 0, 'Via Pietralunga 33 Catania 95124');



insert into casafarmaceutica (PIVA, Nome) values 
(29843270074, "Angelini"),
(57828090423, "Sanofi"),
(72841260671, "Menarini"),
(54894620993, "Bayer"),
(59597930425, "GSK"),
(75490910827, "Marco Viti"),
(77889190235, "Farmaricci"),
(79349030365, "Boiron"),
(56127080572, "Cemon"),
(70698840462, "Corman");

INSERT INTO prodotto (CodiceMinsan, IVA, PrezzoNetto, Immagine) VALUES
(123456, 0.05, 7, 'https://www.farmacosmo.it/13741-medium_default/tachipirina-adulti-1000-mg-analgesico-antipiretico-10-supposte-046384.jpg'),
(2223455, 0.05, 8, 'https://media-services.digital-rb.com/s3/live-productcatalogue/sys-master/images/h93/h7f/8870451380254/Nuroflex%20Render%20Cod.%203120665_ANGLE.jpg?width=1280&height=1280'),
(12345678, 0.03, 5, 'https://static.fogliettoillustrativo.net/ws/b/mannitolo-pani-10g.jpg?1606318663'),
(234879521, 0.04, 8, 'https://www.farmaciapasquino.it/public/prodotti/hires/polase-plus-24-buste_0.jpg'),
(567898765, 0.05, 7, 'https://www.mypharmaclick.com/img_prodotto/768x768/q/verolax-supposte-di-glicerina-per-adulti-18pz_1946.jpg'),
(1567835290, 0.05, 2, 'https://www.enervit.com/shop/pub/media/catalog/product/cache/9f80951979bc60f00064655958126cf3/w/h/whey_conc_cacao_1.jpg'),
(4567809877, 0.08, 4, 'https://images-na.ssl-images-amazon.com/images/I/81SY5t4KVsL._AC_SX425_.jpg'),
(13938890368, 0.04, 7, 'https://www.farmarisparmio.it/images/prodotti/14687/1.jpg'),
(16705270250, 0.04, 10, 'https://www.farmafabs.it/img_prodotto/500x500/angelini-spa-moment-10-capsule-200mg_7868.jpg'),
(16899990556, 0.22, 17, 'https://www.dpfarma.shop/photo/prodotti/crop/300x356/tachipirina-sciroppo-farmaci-da-banco-angelini.jpg'),
(17378960136, 0.22, 12, 'https://www.pharmangelini.com/media/catalog/product/cache/1/small_image/430x404/9df78eab33525d08d6e5fb8d27136e95/a/c/actisinu-angelini-vendita-farmaci-online.jpg'),
(19514350834, 0.04, 8, 'https://www.tuttofarma.it/3409-home_default/infail-dermaclinic-roll-on-alta-tollerabilita-deodorante-50-ml.jpg'),
(23419970407, 0.04, 12, 'https://ipermercatolaquilone.gospesa.it/109926-home_default/angelini-energya-papaya-magnesio-e-potassio-14-x-25-g.jpg'),
(39627690512, 0.04, 10, 'https://www.ilmessaggero.it/photos/HIGH/72/26/5097226_1643_thermacare.jpg'),
(44978351219, 0.04, 7, 'https://www.topfarmacia.it/15987-home_default/tachifludec-10-bustine-arancia.jpg'),
(45809742689, 0.02, 7, 'http://cdn.shopify.com/s/files/1/0011/6316/5754/products/RB_Durex_JEANS_27pk_RBL2001859_ITALY_ECOM.jpg?v=1605520205'),
(57592380208, 0.04, 8, 'https://s1.alpifarma.it/6204-large_default/pietrasanta-pharma-master-aid-quadra-med-cerotti-con-disinfettante.jpg'),
(78348950649, 0.04, 6, 'https://s1.alpifarma.it/6248-large_default/pietrasanta-pharma-master-aid-forte-med-cerotti-con-disinfettante.jpg');


insert into cliente (CF, Nome, Cognome, Telefono) values 
("BBRFNC98R06H919I", "Francesco", "Abruzzese", 3478732545),
("BBRFNC99D49D086V", "Francesca", "Abruzzese", 3376542545),
("BBRGCM98T06D122W", "Giacomo", "Abruzzese", 3928732547),
("BCCCHR98B51C352S", "Chiara", "Boccuto", 3338732735),
("BCCSRN97M70C352P", "Serena", "Boccato", 3353532545),
("BDLVNI93H04C352V", "Ivan", "Badolato", 3953732545),
("BDRSRN99B63L452T", "Serena", "Budroni", 3935662545),
("BFFMNN94P47G317N", "Marianna", "Baffa", 3654334545),
("BFNCLD99A54I874S", "Claudia", "Bifano", 3446738845),
("BFRCCT99C70D086F", "Concetta", "Biafora", 3432826765);



insert into farmacista (NumeroIscrizioneAlbo, Nome, Cognome) values 
(78348950649, "Francesco", "Abruzzese"),
(16705270250, "Francesca", "Abruzzese"),
(23419970407, "Giacomo", "Abruzzese"),
(19514350834, "Chiara", "Boccuto"),
(44978351219, "Serena", "Boccato"),
(17378960136, "Ivan", "Badolato"),
(16899990556, "Serena", "Budroni"),
(39627690512, "Marianna", "Baffa"),
(13938890368, "Claudia", "Bifano"),
(57592380208, "Concetta", "Biafora");



insert into programma_assistenza values 
(25613, "Giardini Naxos"),
(27254, "Messina"),
(13795, "Reggio Emilia"),
(64606, "Taormina"),
(36647, "Trapani"),
(35868, "Siracusa"),
(19259, "Catania"),
(93200, "Catania"),
(71581, "Enna"),
(27642, "Mongiuffi");




insert into medicinale values 
(78348950649, "ibuprofene", "Moment"),
(57592380208, "nafazolina", "Rinazina"),
(13938890368, "sodio bicarbonato", "Citrosodina"),
(39627690512, "tiamina difosfato", "Biochetasi"),
(44978351219, "ambroxolo cloridrato", "Fluibron"),
(19514350834, "efedrina cloridrato", "Deltarinolo");


insert into cosmesi values 
(16899990556, "trattamento viso"),
(17378960136, "trattamento corpo"),
(23419970407, "antiage"),
(16705270250, "filler rughe");


insert into contrattolavoro (Tipo, DataInizio, DataFine, Farmacista, Parafarmacia) VALUES
("Corrente", '1998-08-23', NULL, 13938890368, 2561),
("Corrente", '2006-05-23', NULL, 78348950649, 2725),
("Corrente", '2020-09-23', NULL, 16705270250, 1379),
("Corrente", '1999-03-23', NULL, 23419970407, 6460),
("Corrente", '2004-12-23', NULL, 19514350834, 3664),
("Corrente", '2003-01-23', NULL, 44978351219, 3586),
("Corrente", '1997-04-23', NULL, 17378960136, 1925),
("Corrente", '2018-07-23', NULL, 16899990556, 9320),
("Corrente", '2020-03-23', NULL, 39627690512, 7158),
("Corrente", '1980-09-23', NULL, 57592380208, 2764),
("Passato", '1980-09-23', '2005-05-23', 78348950649, 2764),
("Passato", '1980-09-23', '2003-12-23', 19514350834, 6460),
("Passato", '1980-09-23', '2019-03-23', 39627690512, 2725),
("Passato", '1980-09-23', '1996-04-23', 17378960136, 3664),
("Corrente", '2020-09-23', NULL, 16899990556, 2764),
("Corrente", '2010-03-23', NULL, 23419970407, 2764);


insert into fornitura VALUES
(2561, 29843270074, 78348950649),
(2725, 57828090423, 57592380208),
(1379, 72841260671, 13938890368),
(6460, 54894620993, 39627690512),
(3664, 59597930425, 16899990556),
(3586, 75490910827, 17378960136),
(1925, 77889190235, 44978351219),
(9320, 79349030365, 19514350834),
(7158, 56127080572, 23419970407),
(2764, 70698840462, 16705270250);



insert into acquisto (Prodotto, DataAcquisto, Cliente, Quantita) VALUES
(13938890368, '1998-08-23', "BBRFNC98R06H919I", 2),
(78348950649, '2006-05-23', "BBRFNC99D49D086V", 5),
(16705270250, '2020-09-23', "BBRGCM98T06D122W", 1),
(23419970407, '1999-03-23', "BCCCHR98B51C352S", 6),
(19514350834, '2004-12-23', "BCCSRN97M70C352P", 3),
(44978351219, '2003-01-23', "BDLVNI93H04C352V", 3),
(17378960136, '1997-04-23', "BDRSRN99B63L452T", 1),
(16899990556, '2018-07-23', "BFFMNN94P47G317N", 9),
(39627690512, '2020-03-23', "BFNCLD99A54I874S", 7),
(57592380208, '1980-09-23', "BFRCCT99C70D086F", 2),
(78348950649, '1980-09-23', "BBRFNC98R06H919I", 2),
(19514350834, '1980-09-23', "BBRFNC99D49D086V", 6),
(39627690512, '1980-09-23', "BDLVNI93H04C352V", 2),
(17378960136, '1980-09-23', "BFFMNN94P47G317N", 3);



insert into adesione values 
(2764, 25613);

INSERT INTO users (id, username, password, email, name, surname) VALUES
(1, 'giacomo', '1234', 'r@gmail.com', 'Giacomo', 'Ruvolo'),
(2, 'peppino', '1234567890', 'p@gmail.com', 'peppino', 'calogero');
