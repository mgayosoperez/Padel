-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD DROPEANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `ABP`;
CREATE DATABASE `ABP` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `ABP`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `adminABP`@`localhost`;
	DROP USER `adminABP`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `adminABP`@`localhost` IDENTIFIED BY 'adminABP';
GRANT USAGE ON *.* TO `adminABP`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `ABP`.* TO `adminABP`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--

-- -- TABLA USUARIO
CREATE OR REPLACE TABLE `USUARIO` (
	
	`login` 		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`rol`			enum('DEPORTISTA', 'ENTRENADOR', 'ADMIN') COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_usuario PRIMARY KEY (`login`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA ADMIN
CREATE OR REPLACE TABLE `ADMIN`(

	`login` 		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`password` 		varchar(128) COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_admin PRIMARY KEY (`login`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_login_admin FOREIGN KEY (`login`) REFERENCES `USUARIO` (`login`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA DEPORTISTA
CREATE OR REPLACE TABLE `DEPORTISTA` (

	`login` 		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`password` 		varchar(128) COLLATE latin1_spanish_ci NOT NULL,
	`DNI` 			varchar(9) COLLATE latin1_spanish_ci NOT NULL,
	`nombre` 		varchar(30) COLLATE latin1_spanish_ci  NOT NULL,
	`apellidos` 	varchar(50) COLLATE latin1_spanish_ci NOT NULL,	
	`sexo`			enum('MUJER', 'HOMBRE') COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_deportista PRIMARY KEY (`login`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_login_deportista FOREIGN KEY (`login`) REFERENCES `USUARIO` (`login`) ON DELETE CASCADE,
		-- CLAVES UNICAS
		CONSTRAINT UQ_deportista_dni UNIQUE KEY `DNI` (`DNI`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA ENTRENADOR
CREATE OR REPLACE TABLE `ENTRENADOR` (

	`login` 		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`password` 		varchar(128) COLLATE latin1_spanish_ci NOT NULL,
	`DNI` 			varchar(9) COLLATE latin1_spanish_ci NOT NULL,
	`NSS`			varchar(11) COLLATE latin1_spanish_ci NOT NULL,
	`nombre` 		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`apellidos` 	varchar(50) COLLATE latin1_spanish_ci NOT NULL,
	`sexo`			enum('MUJER', 'HOMBRE') COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_entrenador PRIMARY KEY (`login`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_login_entrenador FOREIGN KEY (`login`) REFERENCES `USUARIO` (`login`) ON DELETE CASCADE,
		-- CLAVES UNICAS
		CONSTRAINT UQ_entrenador_dni UNIQUE KEY `DNI` (`DNI`),
		CONSTRAINT UQ_entrenador_nss UNIQUE KEY `NSS` (`NSS`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA CLASE
CREATE OR REPLACE TABLE `CLASE` (

	`idClase`		int COLLATE latin1_spanish_ci NOT NULL AUTO_INCREMENT,
	`login`			varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`rol`			enum('PARTICULAR', 'GRUPAL') COLLATE latin1_spanish_ci NOT NULL,
	`reserva`		int,


		-- CLAVES PRIMARIAS
		CONSTRAINT PK_clase PRIMARY KEY (`idClase`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_entrenador_clase FOREIGN KEY (`login`) REFERENCES `ENTRENADOR` (`login`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA CLASE_PARTICULAR
CREATE OR REPLACE TABLE `CLASE_PARTICULAR` (

	`idClase`		int NOT NULL,
	`deportista`	varchar(30) COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_clase_particular PRIMARY KEY (`idClase`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idclase_clase_particular FOREIGN KEY (`idClase`) REFERENCES `CLASE` (`idClase`) ON DELETE CASCADE,
		CONSTRAINT FK_deportista_clase_particular FOREIGN KEY (`deportista`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA CLASE_GRUPAL
CREATE OR REPLACE TABLE `CLASE_GRUPAL` (

	`idClase`		int NOT NULL,
	`maxAlumnos`	int COLLATE latin1_spanish_ci NOT NULL,
	`descripcion`	varchar(500) COLLATE latin1_spanish_ci NOT NULL, 

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_clase_grupal PRIMARY KEY (`idClase`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idclase_clase_grupal FOREIGN KEY (`idClase`) REFERENCES `CLASE` (`idClase`) ON DELETE CASCADE
		
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA DEPORTISTA_HAS_CLASE_GRUPAL
CREATE OR REPLACE TABLE `DEPORTISTA_HAS_CLASE_GRUPAL` (

	`idClase`	int NOT NULL,	
	`login`		varchar(15) COLLATE latin1_spanish_ci NOT NULL,	

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_deportista_has_clase_grupal PRIMARY KEY (`idClase`, `login`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idclase_deportista_has_clase_grupal FOREIGN KEY (`idClase`) REFERENCES `CLASE_GRUPAL` (`idClase`) ON DELETE CASCADE,
		CONSTRAINT FK_login_deportista_has_clase_grupal FOREIGN KEY (`login`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA CAMPEONATO
CREATE OR REPLACE TABLE `CAMPEONATO` (

	`idCampeonato`	int NOT NULL AUTO_INCREMENT,
	`nombre`		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`fechaInicio`	date NOT NULL,
	`fechaFin`		date NOT NULL,		

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_campeonato PRIMARY KEY (`idCampeonato`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA LIGA REGULAR
CREATE OR REPLACE TABLE `LIGA_REGULAR` (

	`idLiga`		int NOT NULL AUTO_INCREMENT,
	`fechaInicio`	date NOT NULL,
	`fechaFin`		date NOT NULL,
	`categoria`		enum('FEMENINA', 'MIXTA', 'MASCULINA') COLLATE latin1_spanish_ci NOT NULL,
	`nivel`			enum('1', '2', '3') COLLATE latin1_spanish_ci NOT NULL,
	`idCampeonato`	int,
	

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_liga_regular PRIMARY KEY (`idLiga`, `idCampeonato`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_campeonato_liga_regular FOREIGN KEY (`idCampeonato`) REFERENCES `CAMPEONATO` (`idCampeonato`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA GRUPO
CREATE OR REPLACE TABLE `GRUPO` (

	`idGrupo`		int NOT NULL AUTO_INCREMENT,
	`idLiga`		int,
	-- `categoria`		enum('FEMENINA', 'MIXTA', 'MASCULINA') COLLATE latin1_spanish_ci NOT NULL,
	-- `nivel`			enum('1', '2', '3') COLLATE latin1_spanish_ci NOT NULL,


		-- CLAVES PRIMARIAS
		CONSTRAINT PK_grupo PRIMARY KEY (`idGrupo`,`idLiga`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_liga_grupo FOREIGN KEY (`idLiga`) REFERENCES `LIGA_REGULAR` (`idLiga`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA PAREJA
CREATE OR REPLACE TABLE `PAREJA`(

	`capitan`		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`pareja`		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`idCampeonato`  int NOT NULL,						-- CAMBIADO A NOT NULL
	`categoria`		enum('FEMENINA', 'MIXTA', 'MASCULINA') COLLATE latin1_spanish_ci NOT NULL,
	`nivel`			enum('1', '2', '3') COLLATE latin1_spanish_ci NOT NULL,
	`grupo`			int,
	`puntos`		int,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_pareja PRIMARY KEY (`capitan`, `idCampeonato`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_capitan_pareja FOREIGN KEY (`capitan`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE,
		CONSTRAINT FK_pareja_pareja	FOREIGN KEY (`pareja`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE,
		CONSTRAINT FK_grupo_pareja	FOREIGN KEY (`grupo`) REFERENCES `GRUPO` (`idGrupo`) ON DELETE CASCADE,
		CONSTRAINT FK_idCampeonato_pareja	FOREIGN KEY (`idCampeonato`) REFERENCES `CAMPEONATO` (`idCampeonato`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -- TABLA ENFRENTAMIENTO
CREATE OR REPLACE TABLE `ENFRENTAMIENTO` (
	
	`idPartido`		int NOT NULL AUTO_INCREMENT,
	`idReserva`		int,
	`ganador`		varchar(15) COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_enfrentamiento PRIMARY KEY (`idPartido`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA PAREJA_HAS_ENFRENTAMIENTO
CREATE OR REPLACE TABLE `PAREJA_HAS_ENFRENTAMIENTO` (

	`idPartido`		int NOT NULL,
	`pareja`		varchar(15) COLLATE latin1_spanish_ci NOT NULL,
	`puntos`		int,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_pareja_has_enfrentamiento PRIMARY KEY (`idPartido`, `pareja`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_id_partido_pareja_has_enfrentamiento	FOREIGN KEY (`idPartido`) REFERENCES `ENFRENTAMIENTO` (`idPartido`) ON DELETE CASCADE,
		CONSTRAINT FK_pareja_pareja_has_enfrentamiento	FOREIGN KEY (`pareja`) REFERENCES `PAREJA` (`capitan`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA PISTA
CREATE OR REPLACE TABLE `PISTA` (

	`idPista`		int NOT NULL AUTO_INCREMENT,
	`estado`		varchar(30) COLLATE latin1_spanish_ci NOT NULL,
	`superficie`	varchar(30) COLLATE latin1_spanish_ci NOT NULL,	

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_pista PRIMARY KEY (`idPista`)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci; 

-- -- TABLA RESERVA
CREATE OR REPLACE TABLE `RESERVA` (

	`idReserva`		int NOT NULL AUTO_INCREMENT,
	`fecha`			datetime NOT NULL,
	`idPista`		int NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_reserva PRIMARY KEY (`idReserva`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idPista_reserva FOREIGN KEY (`idPista`) REFERENCES `PISTA` (`idPista`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

ALTER TABLE `CLASE` ADD CONSTRAINT FK_reserva_clase FOREIGN KEY (`reserva`) REFERENCES `RESERVA` (`idReserva`) ON DELETE SET NULL;

ALTER TABLE `ENFRENTAMIENTO` ADD CONSTRAINT FK_idreserva_enfrentamiento	FOREIGN KEY (`idReserva`) REFERENCES `RESERVA` (`idReserva`) ON DELETE SET NULL; 

-- -- TABLA RESERVA_HAS_DEPORTISTA
CREATE OR REPLACE TABLE `RESERVA_HAS_DEPORTISTA` (

	`idReserva`		int NOT NULL,
	`idDeportista`	varchar(15) COLLATE latin1_spanish_ci NOT NULL,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_reserva_has_deportista PRIMARY KEY (`idReserva`, `idDeportista`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idreserva_reserva_has_deportista	FOREIGN KEY (`idReserva`) REFERENCES `RESERVA` (`idReserva`) ON DELETE CASCADE,	
		CONSTRAINT FK_iddeportista_reserva_has_deportista	FOREIGN KEY (`idDeportista`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA PARTIDO PROMOCIONADO
CREATE OR REPLACE TABLE `PARTIDO_PROMOCIONADO` (

	`idPromocionado`	int NOT NULL AUTO_INCREMENT,
	`fecha`			    datetime NOT NULL,
	`idReserva`			int,
	`numDeportista`		int,

		-- CLAVES PRIMARIAS
		CONSTRAINT PK_partido_promocionado PRIMARY KEY (`idPromocionado`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_idreserva_partido_promocionado FOREIGN KEY (`idReserva`) REFERENCES `RESERVA` (`idReserva`) ON DELETE SET NULL

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -- TABLA PROMOCIONADO_HAS_DEPORTISTAS
CREATE OR REPLACE TABLE `PROMOCIONADO_HAS_DEPORTISTA` (

	`idPromocionado`	int NOT NULL,
	`deportista`		varchar(15) COLLATE latin1_spanish_ci NOT NULL,

	-- CLAVES PRIMARIAS
		CONSTRAINT PK_partido_promocionado PRIMARY KEY (`idPromocionado`, `deportista`),
		-- CLAVES FORANEAS
		CONSTRAINT FK_deportista_partido_promocionado FOREIGN KEY (`deportista`) REFERENCES `DEPORTISTA` (`login`) ON DELETE CASCADE,
		CONSTRAINT FK_promocionado_partido_promocionado FOREIGN KEY (`idPromocionado`) REFERENCES `PARTIDO_PROMOCIONADO` (`idPromocionado`) ON DELETE CASCADE

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -- INSERTS

-- -- USUARIOS
INSERT INTO `USUARIO` (`login`, `rol`) VALUES 	('admin', 'ADMIN'), ('aglopez2', 'DEPORTISTA'), ('aglopez3', 'DEPORTISTA'), ('aglopez4', 'DEPORTISTA'), ('aglopez5', 'DEPORTISTA'), ('aglopez6', 'DEPORTISTA'), ('aglopez7', 'DEPORTISTA'), 
												('anacletillo1', 'DEPORTISTA'), ('anacletillo2', 'DEPORTISTA'), ('anacletillo3', 'DEPORTISTA'), ('anacletillo4', 'DEPORTISTA'), ('anacletillo5', 'DEPORTISTA'), ('anacletillo', 'DEPORTISTA'),
												('lordvile', 'DEPORTISTA'), ('1lordvile', 'DEPORTISTA'), ('2lordvile', 'DEPORTISTA'), ('3lordvile', 'DEPORTISTA'), ('4lordvile', 'DEPORTISTA'), ('5lordvile', 'DEPORTISTA'), ('6lordvile', 'DEPORTISTA'),
												('7lordvile', 'DEPORTISTA'), ('1illantasDeCoche', 'DEPORTISTA'), ('2illantasDeCoche', 'DEPORTISTA'), ('3illantasDeCoche', 'DEPORTISTA'), ('4illantasDeCoche', 'DEPORTISTA'), ('5illantasDeCoche', 'DEPORTISTA'),
												('6illantasDeCoche', 'DEPORTISTA'), ('7illantasDeCoche', 'DEPORTISTA'), ('8illantasDeCoche', 'DEPORTISTA'), ('cuestaMucho', 'DEPORTISTA'), ('cuestaMucho1', 'DEPORTISTA'), ('cuestaMucho2', 'DEPORTISTA'),
												('cuestaMucho3', 'DEPORTISTA'), ('deportista1', 'DEPORTISTA'), ('deportista2', 'DEPORTISTA'), ('profe1', 'ENTRENADOR'), ('profe3', 'ENTRENADOR'), ('profe4', 'ENTRENADOR'), ('profe5', 'ENTRENADOR'), 
												('profe6', 'ENTRENADOR'), ('profe7', 'ENTRENADOR');

-- -- ADMIN
INSERT INTO `ADMIN` (`login`, `password`) VALUES ('admin', 'admin');

-- -- PISTA
INSERT INTO `PISTA` (`idPista`, `estado`, `superficie`) VALUES ('1', 'Exterior', 'Cesped'), ('2', 'Exterior', 'Cesped'), ('3', 'Interior', 'Madera'), ('4', 'Exterior', 'Cemento'), ('5', 'Interior', 'Cesped_artificial');

-- -- CAMPEONATO
INSERT INTO `CAMPEONATO` (`idCampeonato`, `nombre`, `fechaInicio`, `fechaFin`) VALUES (NULL, 'Regional', '2019-11-05', '2019-11-12'), (NULL, 'Estatal', '2020-11-05', '2020-11-12');

-- -- DEPORTISTA
INSERT INTO `DEPORTISTA` (`login`, `password`, `DNI`, `nombre`, `apellidos`, `sexo`) VALUES ('aglopez2', '0000000000', '16472834D', 'Angel Alfonso', 'Gulias Lopez', 'HOMBRE'), ('aglopez3', '0000000001', '16472834F', 'Angel Alfonso', 'Gulias Lopez', 'HOMBRE'), 
																							('aglopez4', '0000000002', '16472834H', 'Angel Alfonso', 'Gulias Lopez', 'MUJER'), ('aglopez5', '0000000006', '16472834J', 'Angel Alfonso', 'Gulias Lopez', 'HOMBRE'),
																							('aglopez6', '0000000F00', '16472834A', 'Angel Alfonso', 'Gulias Lopez', 'HOMBRE'), ('aglopez7', '000000S000', '16472834G', 'Angel Alfonso', 'Gulias Lopez', 'HOMBRE'),
																							('anacletillo', '1000000000', '23572834G', 'Ivan', 'Gonzalez Gonzalez', 'HOMBRE'), ('anacletillo1', '10000000F0', '23534567G', 'Ivan', 'Gonzalez Gonzalez', 'HOMBRE'),
																							('anacletillo2', '100F0000F0', '26434567G', 'Ivan', 'Gonzalez Gonzalez', 'MUJER'), ('anacletillo3', '10004456F0', '23538137G', 'Ivan', 'Gonzalez Gonzalez', 'HOMBRE'),
																							('anacletillo4', '10000777F0', '23537772G', 'Ivan', 'Gonzalez Gonzalez', 'HOMBRE'), ('anacletillo5', '1000088880', '23534888G', 'Ivan', 'Gonzalez Gonzalez', 'HOMBRE'),
																							('lordvile', '2222223222', '22222322G', 'Mario', 'Gayoso Perez', 'HOMBRE'), ('1lordvile', '2222222221', '22222221G', 'Mario', 'Gayoso Perez', 'HOMBRE'),
																							('2lordvile', '2223222220', '22222220G', 'Mario', 'Gayoso Perez', 'MUJER'), ('3lordvile', '2222222223', '22222223G', 'Mario', 'Gayoso Perez', 'HOMBRE'),
																							('4lordvile', '2222222242', '22222422G', 'Mario', 'Gayoso Perez', 'HOMBRE'), ('5lordvile', '2222552222', '22552222G', 'Mario', 'Gayoso Perez', 'HOMBRE'),
																							('6lordvile', '2222262222', '22222622G', 'Mario', 'Gayoso Perez', 'MUJER'), ('7lordvile', '2222227722', '22227722G', 'Mario', 'Gayoso Perez', 'HOMBRE'),
																							('1illantasDeCoche', '4445644444', '14253678G', 'David', 'Illan X', 'MUJER'), ('5illantasDeCoche', '4411144444', '14111678G', 'David', 'Illan X', 'HOMBRE'),
																							('2illantasDeCoche', '4444224444', '14222678G', 'David', 'Illan X', 'MUJER'), ('6illantasDeCoche', '4443344444', '14253378G', 'David', 'Illan X', 'HOMBRE'),
																							('3illantasDeCoche', '4440000444', '14200008G', 'David', 'Illan X', 'MUJER'), ('7illantasDeCoche', '4444445444', '14255578G', 'David', 'Illan X', 'HOMBRE'),
																							('4illantasDeCoche', '4444466444', '14253668G', 'David', 'Illan X', 'MUJER'), ('8illantasDeCoche', '4444447444', '14253677G', 'David', 'Illan X', 'HOMBRE'),
																							('cuestaMucho', '0201030608', '99999999G', 'Pedro', 'Cuesta Morales', 'MUJER'), ('cuestaMucho1', '0201110608', '99991199G', 'Pedro', 'Cuesta Morales', 'MUJER'),
																							('cuestaMucho2', '2201030608', '99299999G', 'Pedro', 'Cuesta Morales', 'HOMBRE'), ('cuestaMucho3', '0201033308', '99993399G', 'Pedro', 'Cuesta Morales', 'HOMBRE'),
																							('deportista1', 'deportista1', '76731597D', 'deportista1', 'deportista1', 'HOMBRE'),('deportista2', 'deportista2', '11111111G', 'deportista2', 'deportista2', 'MUJER');
 
-- -- ENTRENADOR
INSERT INTO `ENTRENADOR` (`login`, `password`, `DNI`, `NSS`, `nombre`, `apellidos`, `sexo`) VALUES 	('profe1', '0000000000', '16472834D', '123456789', 'profe', 'guay', 'HOMBRE'), ('profe3', '0000000001', '16472834F', '987654321', 'profe', 'donde esta profe2?', 'HOMBRE'), 
																									('profe4', '0000000002', '16472834H', '123456', 'profe', 'chulo', 'MUJER'), ('profe5', '0000000006', '16472834J', '9876054321', 'profe', 'perezoso', 'HOMBRE'),
																									('profe6', '0000000F00', '16472834A', '126789', 'profe', 'malvado', 'HOMBRE'), ('profe7', '000000S000', '16472834G', '098321', 'ultimo', 'profe', 'HOMBRE');

-- -- CLASE
INSERT INTO `CLASE` (`idClase`, `login`, `rol`, `reserva`) VALUES ('1', 'profe1', 'GRUPAL', NULL), ('2', 'profe4', 'GRUPAL', NULL), ('3', 'profe3', 'GRUPAL', NULL);

-- -- CLASE_GRUPAL
INSERT INTO `CLASE_GRUPAL` (`idClase`, `maxAlumnos`, `descripcion`) VALUES ('1', '20', 'Clase orientada en mejora de saque.'), ('2', '20', 'Clase orientada en mejora de recepción.'), ('3', '20', 'Clase orientada en mejora de ataque.');

-- -- RESERVA
INSERT INTO `RESERVA` (`idReserva`, `fecha`, `idPista`) VALUES 	(NULL , '2019-04-23 18:00', '1'), (NULL, '2019-04-23 18:00', '2'), (NULL, '2019-04-23 18:00', '3'), (NULL, '2019-04-23 18:00', '4'), (NULL, '2019-04-23 18:00', '5'),
																(NULL , '2019-04-24 18:00', '1'), (NULL , '2019-04-24 18:00', '2'), (NULL , '2019-04-24 18:00', '3'), (NULL , '2019-04-24 18:00', '4'), (NULL , '2019-04-24 18:00', '5'),
																(NULL , '2019-04-21 18:00', '1'), (NULL , '2019-11-17 20:00', '1'), (NULL , '2019-11-17 20:00', '2'), (NULL , '2019-11-17 20:00', '3'), (NULL , '2019-11-17 20:00', '4'),
																(NULL , '2019-11-17 20:00', '5'), (NULL , '2019-11-21 18:00', '1'), (NULL , '2019-11-21 18:00', '2'), (NULL , '2019-11-21 18:00', '3'), (NULL , '2019-11-21 18:00', '4'),
																(NULL , '2019-11-21 18:00', '5');

-- -- DEPORTISTA_HAS_CLASE_GRUPAL
INSERT INTO `DEPORTISTA_HAS_CLASE_GRUPAL` (`idClase`, `login`) VALUES 	('1', 'aglopez2'), ('1', 'aglopez3'), ('1', 'aglopez4'), ('1', 'aglopez5'), ('1', 'aglopez6'),
																		('2', 'anacletillo'), ('2', 'anacletillo1'), ('2', 'anacletillo2'), ('2', 'anacletillo3'), ('2', 'anacletillo4'),
																		('2', 'lordvile'), ('2', '1lordvile'), ('2', '2lordvile'), ('2', '3lordvile'), ('2', '4lordvile'),
																		('3', 'cuestaMucho'), ('3', 'cuestaMucho1'), ('3', 'cuestaMucho2'), ('3', 'cuestaMucho3');

-- -- TABLA RESERVA_HAS_DEPORTISTA
INSERT INTO `RESERVA_HAS_DEPORTISTA` (`idReserva`, `idDeportista`) VALUES 	('1', 'aglopez2'), ('3', 'aglopez2'), ('12', 'aglopez2'), ('13', 'aglopez2'), ('14', 'anacletillo'), ('15', 'anacletillo'), ('16', 'anacletillo'),
																			('17', 'deportista1'), ('18', 'deportista1'), ('19', 'deportista1'), ('20', 'deportista1'), ('21', 'deportista1');

-- -- TABLA LIGA_REGULAR
INSERT INTO `LIGA_REGULAR` (`idLiga`, `fechaInicio`, `fechaFin`, `categoria`, `nivel`, `idCampeonato`) VALUES ('1', '2019-11-15', '2020-01-15', 'MASCULINA', '1', '1');

-- -- TABLA GRUPO
INSERT INTO `GRUPO` (`idGrupo`,	`idLiga`) VALUES ('1', '1');

-- -- TABLA PAREJA
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('aglopez2', 'anacletillo', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('aglopez3', 'anacletillo1', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('aglopez5', 'anacletillo3', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('cuestaMucho2', 'cuestaMucho3', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('8illantasDeCoche', '7illantasDeCoche', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('6illantasDeCoche', '5illantasDeCoche', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('deportista1', 'deportista2', '1', 'MASCULINA', '1', '1', '0');
INSERT INTO `PAREJA` (`capitan`, `pareja`, `idCampeonato`, `categoria`, `nivel`, `grupo`, `puntos`) VALUES ('aglopez6', 'aglopez7', '1', 'MASCULINA', '1', '1', '0');																						