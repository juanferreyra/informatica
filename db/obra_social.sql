/*
-- Query: SELECT * FROM turnos.obra_social
LIMIT 0, 1000

-- Date: 2016-08-19 17:05
*/

CREATE TABLE `obra_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro_rnos` varchar(45) DEFAULT NULL,
  `detalle_corto` varchar(45) DEFAULT NULL,
  `detalle` longtext,
  `fecha_creacion` datetime DEFAULT NULL,
  `idusuario` varchar(45) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `paciente_obra_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipodoc` int(11) DEFAULT NULL,
  `nrodoc` int(11) DEFAULT NULL,
  `idobra_social` int(11) DEFAULT NULL,
  `nro_afiliado` varchar(45) DEFAULT NULL,
  `empresa_nombre` varchar(200) DEFAULT NULL,
  `empresa_direccion` varchar(45) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (0,'','S/N','SIN OBRA SOCIAL','2016-08-17 13:22:16','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (1,NULL,'ASE','OBRA SOCIAL ACCION SOCIAL DE EMPRESARIOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (2,NULL,'OSAPYEA','OBRA SOCIAL ACEROS PARANA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (3,NULL,'APDIS','OBRA SOCIAL ASOCIACION DEL PERSONAL DE DIRECCION DE LA INDUSTRIA SIDERURGICA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (4,NULL,'APSOT','OBRA SOCIAL ASOCIACION DEL PERSONAL SUPERIOR DE LA ORGANIZACION TECHINT','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (5,NULL,'OSBA','OBRA SOCIAL BANCARIA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (6,NULL,'OSEIV','OBRA SOCIAL DE  EMPLEADOS DE LA INDUSTRIA DEL VIDRIO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (7,NULL,'OSADEF','OBRA SOCIAL DE  LAS ASOCIACIONES DE EMPLEADOS DE FARMACIA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (8,NULL,'OSAC','OBRA SOCIAL DE ACTORES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (9,NULL,'OSA','OBRA SOCIAL DE AERONAVEGANTES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (10,NULL,'OSALARA','OBRA SOCIAL DE AGENTES DE LOTERIAS Y AFINES DE LA REPUBLICA  ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (11,NULL,'OSAPM','OBRA SOCIAL DE AGENTES DE PROPAGANDA MEDICA DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (12,NULL,'OSADRA','OBRA SOCIAL DE ARBITROS DEPORTIVOS DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (13,NULL,'OSCEP','OBRA SOCIAL DE CAPATACES  ESTIBADORES PORTUARIOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (14,NULL,'OSCOMM','OBRA SOCIAL DE CAPITANES DE ULTRAMAR Y OFICIALES DE LA MARINA MERCANTE','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (15,NULL,'OSCE','OBRA SOCIAL DE CERAMISTAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (16,NULL,'OSCHOCA','OBRA SOCIAL DE CHOFERES DE CAMIONES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (17,NULL,'OSCAMGLYP','OBRA SOCIAL DE COLOCADORES DE AZULEJOS, MOSAICOS, GRANITEROS, LUSTRADORES Y PORCELANEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (18,NULL,'OSCN','OBRA SOCIAL DE COMISARIOS NAVALES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (19,NULL,'OSCCPTAC','OBRA SOCIAL DE CONDUCTORES CAMIONEROS Y PERSONAL DEL TRANSPORTE AUTOMOTOR DE CARGAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (20,NULL,'OSCRAIA','OBRA SOCIAL DE CONDUCTORES DE REMISES Y AUTOS AL INSTANTE Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (21,NULL,'CTCP','OBRA SOCIAL DE CONDUCTORES DE TRANSPORTE COLECTIVO DE PASAJEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (22,NULL,'OSCONARA','OBRA SOCIAL DE CONDUCTORES NAVALES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (23,NULL,'OSDO','OBRA SOCIAL DE DIRECCION OSDO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (24,NULL,'WITCEL','OBRA SOCIAL DE DIRECCIÓN WITCEL','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (25,NULL,'OSDOP','OBRA SOCIAL DE DOCENTES PARTICULARES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (26,NULL,'OSEDA','OBRA SOCIAL DE EMPLEADOS DE DESPACHANTES DE ADUANA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (27,NULL,'OSEMM','OBRA SOCIAL DE EMPLEADOS DE LA MARINA MERCANTE','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (28,NULL,'OSETRA','OBRA SOCIAL DE EMPLEADOS DEL TABACO DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (29,NULL,'OSETYA','OBRA SOCIAL DE EMPLEADOS TEXTILES Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (30,NULL,'OSEAM','OBRA SOCIAL DE ENCARGADOS APUNTADORES MARITIMOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (31,NULL,'OSFOT','OBRA SOCIAL DE FOTOGRAFOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (32,NULL,'OSGMGM','OBRA SOCIAL DE GUINCHEROS Y MAQUINISTAS DE GRUAS MOVILES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (33,NULL,'OSJPVYF','OBRA SOCIAL DE JARDINEROS, PARQUISTAS, VIVERISTAS Y FLORICULTORES DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (34,NULL,'OSJOMN','OBRA SOCIAL DE JEFES Y OFICIALES MAQUINISTAS NAVALES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (35,NULL,'OSSEG','OBRA SOCIAL DE LA ACTIVIDAD DE SEGUROS, REASEGUROS, CAPITALIZACION Y AHORRO Y PRESTAMO PARA LA VIVIENDA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (36,NULL,'OSAM','OBRA SOCIAL DE LA ACTIVIDAD MINERA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (37,NULL,'OSFATUN','OBRA SOCIAL DE LA FEDERACION ARGENTINA DEL TRABAJADOR  DE LAS UNIVERSIDADES NACIONALES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (38,NULL,'FEDECAMARAS','OBRA SOCIAL DE LA FEDERACION DE CAMARAS Y CENTROS COMERCIALES ZONALES DE LA REPUBLICA ARGENTINA (FEDECAMARAS)','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (39,NULL,'OSFGPICD','OBRA SOCIAL DE LA FEDERACION GREMIAL DE LA INDUSTRIA DE LA CARNE Y SUS DERIVADOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (40,NULL,'OSIPA','OBRA SOCIAL DE LA INDUSTRIA DE PASTAS ALIMENTICIAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (41,NULL,'OSUOMRA','OBRA SOCIAL DE LA UNION OBRERA METALURGICA DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (42,NULL,'OSDEL','OBRA SOCIAL DE LOCUTORES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (43,NULL,'OSSIMRA','OBRA SOCIAL DE LOS  SUPERVISORES DE LA INDUSTRIA METALMECANICA DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (44,NULL,'OSUCI','OBRA SOCIAL DE LOS CORTADORES DE LA INDUMENTARIA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (45,NULL,'OSECAC','OBRA SOCIAL DE LOS EMPLEADOS DE COMERCIO Y ACTIVIDADES CIVILES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (46,NULL,'OSPUAYE','OBRA SOCIAL DE LOS PROFESIONALES UNIVERSITARIOS DEL AGUA Y LA ENERGIA ELECTRICA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (47,NULL,'OSTEE','OBRA SOCIAL DE LOS TRABAJADORES DE LAS EMPRESAS DE ELECTRICIDAD','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (48,NULL,'OSMTT','OBRA SOCIAL DE MAQUINISTAS DE TEATRO Y TELEVISION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (49,NULL,'OSDEM','OBRA SOCIAL DE MUSICOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (50,NULL,'OSOEFRNN','OBRA SOCIAL DE OBREROS EMPACADORES DE FRUTA  DE RIO NEGRO Y NEUQUEN','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (51,NULL,'OSOETSYLARA','OBRA SOCIAL DE OBREROS Y EMPLEADOS TINTOREROS SOMBREREROS Y LAVADEROS DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (52,NULL,'OSPCRP','OBRA SOCIAL DE PATRONES DE CABOTAJE DE RIOS Y PUERTOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (53,NULL,'OSPETAX','OBRA SOCIAL DE PEONES DE TAXIS DE LA CAPITAL FEDERAL','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (54,NULL,'OSPET','OBRA SOCIAL DE PETROLEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (55,NULL,'OSPAR','OBRA SOCIAL DE PORTUARIOS ARGENTINOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (56,NULL,'OSRJA','OBRA SOCIAL DE RELOJEROS Y JOYEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (57,NULL,'OSSB','OBRA SOCIAL DE SERENOS DE BUQUES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (58,NULL,'OSTECF','OBRA SOCIAL DE TECNICOS DE FUTBOL','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (59,NULL,'OSTVLA','OBRA SOCIAL DE TECNICOS DE VUELO DE LINEAS AEREAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (60,NULL,'OSTIG','OBRA SOCIAL DE TRABAJADORES DE LA INDUSTRIA DEL GAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (61,NULL,'OSTRAC','OBRA SOCIAL DE TRABAJADORES DE LAS COMUNICACIONES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (62,NULL,'OSTPBA','OBRA SOCIAL DE TRABAJADORES DE PRENSA DE BUENOS AIRES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (63,NULL,'OSV','OBRA SOCIAL DE VAREADORES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (64,NULL,'OSVARA','OBRA SOCIAL DE VENDEDORES AMBULANTES DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (65,NULL,'OSVVRA','OBRA SOCIAL DE VIAJANTES VENDEDORES DE LA REPUBLICA ARGENTINA. (ANDAR)','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (66,NULL,'OSYC','OBRA SOCIAL DE YACIMIENTOS CARBONIFEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (67,NULL,'OSPATCA','OBRA SOCIAL DEL PERSONAL ADMINISTRATIVO Y TECNICO DE LA CONSTRUCCION Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (68,NULL,'OSPA','OBRA SOCIAL DEL PERSONAL AERONAUTICO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (69,NULL,'OSPACP','OBRA SOCIAL DEL PERSONAL AUXILIAR DE CASAS PARTICULARES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (70,NULL,'OSPADEP','OBRA SOCIAL DEL PERSONAL DE AERONAVEGACION DE ENTES PRIVADOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (71,NULL,'OSPAGA','OBRA SOCIAL DEL PERSONAL DE AGUAS GASEOSAS Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (72,NULL,'OSPBLCA','OBRA SOCIAL DEL PERSONAL DE BARRACAS DE LANAS, CUEROS Y ANEXOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (73,NULL,'OSPCYD','OBRA SOCIAL DEL PERSONAL DE CARGA Y DESCARGA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (74,NULL,'OSIM','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE LA INDUSTRIA METALURGICA  Y DEMAS ACTIVIDADES EMPRESARIAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (75,NULL,'OSDIPP','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE LA INDUSTRIA PRIVADA DEL PETROLEO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (76,NULL,'OSLPASTEUR','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE LA SANIDAD LUIS PASTEUR','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (77,NULL,'OPDEA','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE LAS EMPRESAS DE LA ALIMENTACION Y DEMAS ACTIVIDADES EMPRESARIAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (78,NULL,'FRUTOS','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE LAS EMPRESAS QUE ACTUAN EN FRUTOS DEL PAIS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (79,NULL,'WHOPE','OBRA SOCIAL DEL PERSONAL DE DIRECCION DE PERFUMERIA E.W. HOPE','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (80,NULL,'OSPERYHRA','OBRA SOCIAL DEL PERSONAL DE EDIFICIOS DE RENTA Y HORIZONTAL DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (81,NULL,'OSPEFYEPCA','OBRA SOCIAL DEL PERSONAL DE EMPRESAS FIAT Y EMPRESAS PEUGEOT CITROEN ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (82,NULL,'OSPEDYC','OBRA SOCIAL DEL PERSONAL DE ENTIDADES DEPORTIVAS Y CIVILES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (83,NULL,'OSPE','OBRA SOCIAL DEL PERSONAL DE ESCRIBANOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (84,NULL,'OSPESGYPE','OBRA SOCIAL DEL PERSONAL DE ESTACIONES DE SERVICIO, GARAGES, PLAYAS DE ESTACIONAMIENTO Y LAVADEROS AUTOMATICOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (85,NULL,'UPFPARA','OBRA SOCIAL DEL PERSONAL DE FABRICAS DE PINTURA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (86,NULL,'OSPF','OBRA SOCIAL DEL PERSONAL DE FARMACIA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (87,NULL,'OSPIDA','OBRA SOCIAL DEL PERSONAL DE IMPRENTA, DIARIOS Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (88,NULL,'OSPIQYP','OBRA SOCIAL DEL PERSONAL DE INDUSTRIAS QUIMICAS Y PETROQUIMICAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (89,NULL,'OSPIS','OBRA SOCIAL DEL PERSONAL DE INSTALACIONES SANITARIAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (90,NULL,'OSPEJ','OBRA SOCIAL DEL PERSONAL DE JABONEROS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (91,NULL,'OSPACA','OBRA SOCIAL DEL PERSONAL DE LA ACTIVIDAD CERVECERA Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (92,NULL,'OSPAT','OBRA SOCIAL DEL PERSONAL DE LA ACTIVIDAD DEL TURF','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (93,NULL,'OSPAP','OBRA SOCIAL DEL PERSONAL DE LA ACTIVIDAD PERFUMISTA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (94,NULL,'OSPAV','OBRA SOCIAL DEL PERSONAL DE LA ACTIVIDAD VITIVINICOLA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (95,NULL,'OSPECON','OBRA SOCIAL DEL PERSONAL DE LA CONSTRUCCION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (96,NULL,'OSPEC','OBRA SOCIAL DEL PERSONAL DE LA EMPRESA NACIONAL DE CORREOS Y TELEGRAFOS S.A. Y DE LAS  COMUNICACIONES DE LA REPULICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (97,NULL,'OSPEP','OBRA SOCIAL DEL PERSONAL DE LA ENSEÑANZA PRIVADA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (98,NULL,'OSPIA','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DE LA ALIMENTACION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (99,NULL,'OSPICAL','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL CALZADO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (100,NULL,'OSPIC','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL CAUCHO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (101,NULL,'OSPICHA','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL CHACINADO Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (102,NULL,'OSPICA','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL CUERO Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (103,NULL,'OSPIHMP','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL HIELO Y MERCADOS PARTICULARES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (104,NULL,'OSPIP','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL PLASTICO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (105,NULL,'OSPIV','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL VESTIDO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (106,NULL,'OSPIVE','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA DEL VIDRIO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (107,NULL,'OSPILM','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA LADRILLERA A MAQUINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (108,NULL,'OSPIL','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA LECHERA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (109,NULL,'OSPIM','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA MADERERA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (110,NULL,'OSPIMO','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA MOLINERA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (111,NULL,'OSPIT','OBRA SOCIAL DEL PERSONAL DE LA INDUSTRIA TEXTIL','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (112,NULL,'OSPP','OBRA SOCIAL DEL PERSONAL DE LA PUBLICIDAD','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (113,NULL,'OSPSA','OBRA SOCIAL DEL PERSONAL DE LA SANIDAD ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (114,NULL,'OSTEL','OBRA SOCIAL DEL PERSONAL DE LAS TELECOMUNICACIONES DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (115,NULL,'OSLYF','OBRA SOCIAL DEL PERSONAL DE LUZ Y FUERZA DE CORDOBA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (116,NULL,'OSPM','OBRA SOCIAL DEL PERSONAL DE MAESTRANZA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (117,NULL,'OSPEPA','OBRA SOCIAL DEL PERSONAL DE PANADERIAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (118,NULL,'OSPPEA','OBRA SOCIAL DEL PERSONAL DE PELUQUERIAS, ESTETICAS Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (119,NULL,'OSPPRA','OBRA SOCIAL DEL PERSONAL DE PRENSA DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (120,NULL,'OSPSIP','OBRA SOCIAL DEL PERSONAL DE SEGURIDAD COMERCIAL, INDUSTRIAL E INVESTIGACIONES PRIVADAS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (121,NULL,'OSPESA','OBRA SOCIAL DEL PERSONAL DE SOCIEDADES DE AUTORES Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (122,NULL,'OSPTV','OBRA SOCIAL DEL PERSONAL DE TELEVISION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (123,NULL,'OSPACLA','OBRA SOCIAL DEL PERSONAL DEL AUTOMOVIL  CLUB ARGENTINO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (124,NULL,'OSPECA','OBRA SOCIAL DEL PERSONAL DEL CAUCHO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (125,NULL,'OSPEPU','OBRA SOCIAL DEL PERSONAL DEL ESPECTACULO PUBLICO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (126,NULL,'OSPOCE','OBRA SOCIAL DEL PERSONAL DEL ORGANISMO DE CONTROL EXTERNO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (127,NULL,'OSPPCYQ','OBRA SOCIAL DEL PERSONAL DEL PAPEL, CARTON Y QUIMICOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (128,NULL,'OSUTHGRA','OBRA SOCIAL DEL PERSONAL DEL TURISMO, HOTELERO Y GASTRONOMICO DE LA UNION  DE TRABAJADORES  DEL TURISMO HOTELEROS Y GASTRONOMICOS DE LA REPUBLICA  ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (129,NULL,'OSDIC','OBRA SOCIAL DEL PERSONAL DIRECTIVO DE LA INDUSTRIA DE LA CONSTRUCCION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (130,NULL,'OSPG','OBRA SOCIAL DEL PERSONAL GRAFICO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (131,NULL,'OSJERA','OBRA SOCIAL DEL PERSONAL JERARQUICO DE LA REPUBLICA ARGENTINA PARA EL PERSONAL JERARQUICO DE LA INDUSTRIA GRAFICA Y EL PERSONAL JERARQUICO DEL AGUA Y LA ENERGIA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (132,NULL,'OSPMA','OBRA SOCIAL DEL PERSONAL MARITIMO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (133,NULL,'OSPMJCHPSI','OBRA SOCIAL DEL PERSONAL MENSUALIZADO DEL JOCKEY CLUB DE BUENOS AIRES Y LOS HIPODROMOS DE PALERMO Y SAN ISIDRO                                                                                   ','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (134,NULL,'OSPRERA','OBRA SOCIAL DEL PERSONAL RURAL Y ESTIBADORES DE LA REPUBLICA ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (135,NULL,'OSSHELL','OBRA SOCIAL DEL PERSONAL SHELL-CAPSA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (136,NULL,'OSPEA','OBRA SOCIAL DEL PERSONAL SUPERIOR Y PROFESIONAL DE EMPRESAS AEROCOMERCIALES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (137,NULL,'OSPTA','OBRA SOCIAL DEL PERSONAL TECNICO AERONAUTICO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (138,NULL,'OSPEGAP','OBRA SOCIAL DEL PETROLEO Y GAS PRIVADO','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (139,NULL,'OSMATA','OBRA SOCIAL DEL SINDICATO DE MECANICOS Y AFINES DEL TRANSPORTE AUTOMOTOR','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (140,NULL,'OSFE','OBRA SOCIAL FERROVIARIA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (141,NULL,'OSMA','OBRA SOCIAL MODELOS ARGENTINOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (142,NULL,'MITA','OBRA SOCIAL MUTUALIDAD INDUSTRIAL TEXTIL ARGENTINA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (143,NULL,'OSPELMM','OBRA SOCIAL PARA EL  PERSONAL DE EMPRESAS DE  LIMPIEZA, SERVICIOS Y MAESTRANZA DE MENDOZA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (144,NULL,'OSEDEIV','OBRA SOCIAL PARA EL PERSONAL DE DIRECCION DE LA INDUSTRIA VITIVINICOLA Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (145,NULL,'OSIAD','OBRA SOCIAL PARA EL PERSONAL DE LA INDUSTRIA ACEITERA, DESMOTADORA Y AFINES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (146,NULL,'OSOSS','OBRA SOCIAL PARA EL PERSONAL DE OBRAS Y SERVICIOS SANITARIOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (147,NULL,'OSPLAD','OBRA SOCIAL PARA LA ACTIVIDAD DOCENTE','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (148,NULL,'OSTEP','OBRA SOCIAL PARA LOS TRABAJADORES DE LA EDUCACION PRIVADA','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (149,NULL,'OSPLA','OBRA SOCIAL PARA PILOTOS DE LINEAS AEREAS COMERCIALES Y REGULARES','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (150,NULL,'OSPCN','OBRA SOCIAL UNION PERSONAL DE LA UNION DEL  PERSONAL CIVIL DE LA NACION','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (151,NULL,'OSYPF','OBRA SOCIAL YPF','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (152,NULL,'OSDE','OSDE ORGANIZACION DE SERVICIOS DIRECTOS EMPRESARIOS','2016-08-10 13:31:13','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (153,'','PAMI','OBRA SOCIAL DE JUBILADOS Y PENSIONADOS','2016-08-17 13:22:16','0',1);
INSERT INTO `obra_social` (`id`,`nro_rnos`,`detalle_corto`,`detalle`,`fecha_creacion`,`idusuario`,`habilitado`) VALUES (154,NULL,'SUMAR','PROGRAMA SUMAR','2016-08-17 13:22:16','0',1);
