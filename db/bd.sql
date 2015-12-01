drop table usuarios cascade;/*1*/
drop table noticias cascade;/*2*/
drop table secciones cascade;/*3*/
drop table temas cascade;/*4*/
drop table posts cascade;/*5*/
drop table comentarios cascade;/*6*/
drop table estados cascade;/*7*/
drop table juegos cascade;/*8*/
drop table partidas cascade;/*9*/
drop table fichas cascade;/*10*/
drop table chat cascade;/*11*/
drop table tablas cascade;/*12*/






/*
*   --------1
*   USUARIOS
*   --------
*/

create table usuarios	(
	id					bigserial		constraint pk_usuarios primary key,
	usuario				varchar(10)		not null 
										constraint uq_usuarios_usuario unique,
	email				varchar(75)		not null 
										constraint uq_usuarios_email unique,
	passwd				char(32)		not null,
	admin         		boolean       	default false,
	created_at			timestamp		default current_timestamp,
	updated_at			timestamp		default null,
	deleted_at			timestamp		default	null,
	deleted				boolean			default false
);

create index idx_usuarios_usuario_passwd on usuarios (usuario, passwd);



/*
*   --------2
*   NOTICIAS
*   --------
*/

create table noticias (
	id					bigserial		constraint pk_noticias primary key,
	titulo        		varchar(50)   	not null,
	autor         		bigint        	constraint fk_noticias_usuarios
												references usuarios (id),
	contenido     		text,
	created_at       	timestamp       default current_timestamp,
	updated_at			timestamp		default null,
	deleted_at			timestamp		default null,
	deleted				boolean			default false
);


/*
*   ----
*   ----
*   FORO
*   ----
*   ----
*/



/*
*   ---------3
*   SECCIONES
*   ---------
*/

create table secciones (
	id					bigserial			constraint pk_secciones primary key,
	titulo        		varchar(50)   		not null constraint uq_titulo_secciones unique,
	descripcion   		varchar(100)  		not null
);


/*
*   -----4
*   TEMAS
*   -----
*/

create table temas (
	id					bigserial			constraint pk_temas primary key,
	titulo        		varchar(50)   		not null constraint uq_titulo_temas unique,
	seccion       		bigint        		constraint fk_temas_secciones
													references secciones (id),
	descripcion			varchar(100)		not null
);


/*
*   -----5
*   POSTS
*   -----
*/

create table posts (
	id					bigserial		constraint pk_posts primary key,
	titulo				varchar(50)		not null constraint uq_titulos_posts unique,
	contenido     		text          	not null,
	autor         		bigint        	constraint fk_posts_usuarios
												references usuarios (id),
	tema       			bigint        	constraint fk_posts_temas
												references temas (id),
	fecha         		timestamp      	default current_timestamp
);


/*
*	-----------6
*	COMENTARIOS
*	-----------
*/

create table comentarios (
	id					bigserial		constraint pk_comentarios primary key,
	contenido			text			not null,
	autor				bigint			constraint fk_comentarios_usuarios
												references usuarios (id),
	post				bigint			constraint fk_comentarios_posts
												references posts (id),
	fecha				timestamp		default current_timestamp
);




/*
*	-------------
*   -------------
*   JUEGOS DE ROL
*   -------------
*	-------------
*/

/*
*	------------------7
*	ESTADOS DE PARTIDA
*	------------------
*/
create table estados (
	id					bigserial		constraint pk_estados primary key,
	estado				varchar(20)		not null
);

/*
*	------8
*	JUEGOS
*	------
*/
create table juegos (
	id					bigserial		constraint pk_tipos_juego primary key,
	nombre				varchar(50)		not null
										constraint uq_tipos_juego_nombre unique,
	descripcion			text,
	deleted				boolean			default false
);

/*
*	--------9
*	PARTIDAS
*	--------
*/
create table partidas (
	id					bigserial		constraint pk_partidas primary key,
	nombre				varchar(20)		not null,
	descripcion			varchar(100),
	master				bigint			constraint fk_partidas_usuarios
												references usuarios (id),
	tipo_juego			bigint			constraint fk_partida_juego
												references juegos (id),
	estado				bigint			not null
										constraint fk_partidas_estados
												references estados (id),
	activa				boolean			default false,
	created_at       	timestamp       default current_timestamp,
	updated_at			timestamp		default null,
	deleted_at			timestamp		default null,
	deleted				boolean			default false
);

/*
*	------10
*	FICHAS
*	------
*/
create table fichas (
	id					bigserial		constraint pk_fichas primary key,
	usuario_id			bigint			default null,
	partida_id			bigint			default null,
	deleted				boolean			default false
);


/*
*   ----11
*   CHAT
*   ----
*/

create table chat (
	id					bigserial		constraint pk_chat primary key,
	mensaje				varchar(200) 	not null,
	jugador				bigint    	 	not null
										constraint fk_chat_usuarios
												references usuarios (id),
	partida				bigint			not null 
										constraint fk_chat_partidas
												references partidas (id),
	momento				timestamp    	default current_timestamp
);


create table tablas (
	id					bigserial		constraint pk_tablas primary key,
	juego				bigint			constraint fk_tablas_juegos 
												references juegos (id),
	tabla				varchar(50)
);





/*
*  -----------------
*  TABLA DE SESIONES
*  -----------------
*/
drop table ci_session cascade;

CREATE TABLE ci_session (
	id					varchar(40) 	NOT NULL,
	ip_address 			varchar(45) 	NOT NULL,
	timestamp 			bigint 			DEFAULT 0 NOT NULL,
	data 				text 			DEFAULT '' NOT NULL
);

CREATE INDEX ci_session_timestamp ON ci_session(timestamp);
