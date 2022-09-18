create table registrar_votaciones(
    numero_documento int primary key not null,
    cod_tipo_documento int not null,
    nombres varchar(45) not null,
    apellidos varchar(45) not null,
    cod_formacion int not null,
    cod_sede int not null,
    numero_votos int not null,
    fotografia varchar(45) not null,
    propuesta_campaña varchar(300) not null,
    contraseñas varchar(45) not null

);
create table gestionar_votantes(
    numero_documento int primary key not null,
    cod_tipo_documento int not null,
    nombres varchar(45) not null,
    apellidos varchar(45) not null,
    cod_formacion int not null,
    cod_sede int not null
);
create table agendar_votaciones(
    id int AUTO_INCREMENT not null primary key,
    descripcion_votacion varchar(300) not null,
    fecha_inicio date not null,
    fecha_final date not null,
    hora_inicio time not null,
    hora_final time not null,
    estado int not null
);
create table realizar_votaciones(
    cedula_tarjeta int primary key not null,
    nombres varchar(45) not null,
    apellidos varchar(45) not null,
    cod_formacion int not null,
    cod_sede int not null,
    fotografia varchar(45) not null
);
create table tipo_documento(
    codigo int primary key not null,
    nombre varchar(45) not null

);
create table formacion(
    codigo int primary key not null,
    nombre varchar(45) not null

);
create table sede(
    codigo int primary key not null,
    nombre varchar(45) not null
);
create table usuario(
    usuario int primary key not null,
    clave varchar(45) not null,
    nombre_apellido varchar(45) not null,
    rol int not null,
    estado int not null
);

ALTER TABLE registrar_votaciones ADD CONSTRAINT fk_tipo_documento_registrar_votaciones
FOREIGN KEY (cod_tipo_documento) REFERENCES tipo_documento(codigo);

ALTER TABLE registrar_votaciones ADD CONSTRAINT fk_formacion_registrar_votaciones
FOREIGN KEY (cod_formacion) REFERENCES formacion(codigo);

ALTER TABLE registrar_votaciones ADD CONSTRAINT fk_sede_registrar_votaciones
FOREIGN KEY (cod_sede) REFERENCES sede(codigo);

ALTER TABLE gestionar_votantes ADD CONSTRAINT fk_tipo_documento_gestionar_votantes
FOREIGN KEY (cod_tipo_documento) REFERENCES tipo_documento(codigo);

ALTER TABLE gestionar_votantes ADD CONSTRAINT fk_formacion_gestionar_votantes
FOREIGN KEY (cod_formacion) REFERENCES formacion(codigo);

ALTER TABLE gestionar_votantes ADD CONSTRAINT fk_sede_gestionar_votantes
FOREIGN KEY (cod_sede) REFERENCES sede(codigo);

ALTER TABLE realizar_votaciones ADD CONSTRAINT fk_formacion_realizar_votaciones
FOREIGN KEY (cod_formacion) REFERENCES formacion(codigo);

ALTER TABLE realizar_votaciones ADD CONSTRAINT fk_sede_realizar_votaciones
FOREIGN KEY (cod_sede) REFERENCES sede(codigo);

ALTER TABLE gestionar_votantes ADD CONSTRAINT fk_usuario_gestionar_votantes
FOREIGN KEY (numero_documento) REFERENCES usuario(usuario); 


insert into tipo_documento value (01,'C.C');
insert into tipo_documento value (02,'T.I');
insert into tipo_documento value (03,'C.E');

insert into formacion value (10,'ADSI');
insert into formacion value (11,'Gestion administrativa');
insert into formacion value (12,'Panaderia');

insert into sede value (001,'La Gallera');
insert into sede value (002,'Boston');
insert into sede value (003,'Tolu');

insert into usuario value(1,123,'Ronald Millan',1,0);
insert into usuario value(2,321,'isaac canchano',2,0);
insert into usuario value(3,789,'andres perez',2,0);

