
-- creacion de base de datos 
create database dataHotel;

-- seleccion de la base de datos
use dataHotel;

----------------------------
-- creacion de tablas
----------------------------
create table departamentos(
id int not null,
nombre varchar(100) not null,
letra varchar(5) not null,
primary key(id)
);


create table ciudades(
id int not null,
nombre varchar(100) not null,
id_departamento int not null,
primary key(id)
);

create table hoteles(
id int auto_increment not null,
nit varchar(100) not null,
nombre varchar(500) not null,
direccion varchar(500) not null,
id_ciudad int not null,
habitaciones tinyint not null,
created_at datetime not null,
updated_at datetime,
UNIQUE(nit),
primary key(id)
);


create table habitaciones(
id tinyint not null,
nombre varchar(100) not null,
primary key(id)
);

create table acomodaciones(
id tinyint not null,
nombre varchar(100) not null,
primary key(id)
);

create table acomodacionhabitaciones(
id int auto_increment not null,
id_habitacion tinyint not null,
id_acomodacion tinyint not null,
UNIQUE(id_habitacion,id_acomodacion),
primary key(id)
);


create table habitacioneshoteles(
id int auto_increment not null,
id_hotel int not null,
id_acomodacion_h int not null,
cantidad tinyint not null,
UNIQUE(id_hotel,id_acomodacion_h),
primary key(id)
);


-- Relaciones 

alter table ciudades add constraint fk_ciudades_dep
foreign key (id_departamento) references departamentos(id);

alter table hoteles add constraint fk_hoteles_ciudades
foreign key (id_ciudad) references ciudades(id);


alter table acomodacionhabitaciones add constraint fk_acomodacion_habitacion
foreign key (id_acomodacion) references acomodaciones(id);

alter table acomodacionhabitaciones add constraint fk_habitacion_acomodacion
foreign key (id_habitacion) references habitaciones(id);



alter table habitacioneshoteles add constraint fk_habitaciones_hoteles
foreign key (id_hotel) references hoteles(id);

alter table habitacioneshoteles add constraint fk_acomodacionhab_hoteles
foreign key (id_acomodacion_h) references acomodacionhabitaciones(id);


-- vista 

CREATE VIEW 
info_ciudades AS 
select 
ciudades.id as ide_c,
ciudades.nombre as ciudad,
ciudades.id_departamento,
departamentos.nombre as departamento,
departamentos.letra as letra_departamento
from ciudades,departamentos
where ciudades.id_departamento = departamentos.id



-- datos iniciales 


insert into departamentos(id,nombre,letra) values
(2,'Antioquia','ANT'),
(4,'Atlantico','ATL'),
(10,'Cauca','CAU'),
(19,'Magdalena','MAG'),
(26,'San Andres y Providencia','SAP'),
(30,'Valle del Cauca','VAC'),
(34,'Distrito Capital','BOG');

insert into ciudades(id,nombre,id_departamento) values
(16,'Armenia',2),
(17,'Barbosa',2),
(18,'Bello',2),
(26,'Caldas',2),
(40,'Copacabana',2),
(47,'Envigado',2),
(52,'Granada',2),
(55,'Guatapé',2),
(59,'Itagüí',2),
(64,'La Estrella',2),
(70,'Medellín',2),
(79,'Peñol',2),
(81,'Puerto Berrío',2),
(83,'Puerto Triunfo',2),
(85,'Retiro',2),
(86,'Ríonegro',2),
(87,'Sabanalarga',2),
(88,'Sabaneta',2),
(89,'Salgar',2),
(91,'San Carlos',2),
(92,'San Francisco',2),
(93,'San Jerónimo',2),
(99,'San Rafael',2),
(102,'Santa Bárbara',2),
(103,'Santa Fé de Antioquia',2),
(107,'Segovia',2),
(108,'Sonsón',2),
(113,'Toledo',2),
(114,'Turbo',2),
(117,'Urrao',2),
(118,'Valdivia',2),
(119,'Valparaiso',2),
(125,'Yolombó',2),
(136,'Barranquilla',4),
(143,'Manatí',4),
(148,'Puerto Colombia',4),
(150,'Sabanagrande',4),
(151,'Sabanalarga',4),
(152,'Santa Lucía',4),
(153,'Santo Tomás',4),
(154,'Soledad',4),
(397,'Corinto',10),
(398,'El Tambo',10),
(399,'Florencia',10),
(414,'Popayán',10),
(419,'San Sebastián',10),
(420,'Santa Rosa',10),
(430,'Villa Rica',10),
(525,'Bogotá',34),
(692,'Aracataca',19),
(696,'Ciénaga',19),
(701,'Fundación',19),
(707,'Plato',19),
(711,'Salamina',19),
(716,'Santa Marta',19),
(893,'Providencia',26),
(1059,'Buenaventura',30),
(1060,'Buga',30),
(1061,'Bugalagrande',30),
(1064,'Calí',30),
(1065,'Candelaria',30),
(1072,'Florida',30),
(1075,'Jamundí',30),
(1076,'La Cumbre',30),
(1077,'La Unión',30),
(1078,'La Victoria',30),
(1079,'Obando',30),
(1080,'Palmira',30),
(1081,'Pradera',30),
(1082,'Restrepo',30),
(1089,'Tulúa',30),
(1108,'San Andres',26);



insert into habitaciones (id,nombre)values
(1,'Estandar'),
(2,'Junior'),
(3,'Suite');

insert into acomodaciones (id,nombre)values
(1,'Sencilla'),
(2,'Doble'),
(3,'Triple'),
(4,'Cuadruple');

insert into acomodacionhabitaciones (id_habitacion,id_acomodacion)values
(1,1),
(1,2),
(2,3),
(2,4),
(3,1),
(3,2),
(3,3);






