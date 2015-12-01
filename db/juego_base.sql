drop table inventario cascade;
drop table anotaciones cascade;

create table inventario (
	id					bigserial		constraint pk_inventarios primary key,
	objeto				varchar(20)		not null,
	descripcion			varchar(50),
	cantidad			numeric(3) 		not null,
	ficha				bigint			
);

create table anotaciones (
	ficha				bigint,
	texto				text			default ''
);