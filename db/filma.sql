drop table if exists peliculas cascade;

create table peliculas(
    id bigserial constraint pk_peliculas primary key,
    titulo varchar(50) not null,
    descricion text not null


);

drop table if exists usuarios cascade;

create table usuarios (
    id         bigserial    constraint pk_usuarios primary key,
    nombre     varchar(15)  not null constraint uq_usuarios_nombre unique,
    password   varchar(60)  not null,
    email      varchar(255) not null,
    token      varchar(32),
    activacion varchar(32),
    created_at timestamptz  default current_timestamp
);

drop table if exists genero cascade;
create table genero(
    id bigserial constraint  pk_genero primary key,
    nombre_genero varchar(50) not null unique
);

drop table if exists participantes cascade;
create table participantes(
    id bigserial constraint pk_participantes primary key,
    nombre_participante varchar(100) not null
);

drop table if exists roles cascade;
create table roles(
    id bigserial constraint pk_roles primary key,
    nombre_rol varchar(50) not null unique
);

drop table if exists participaciones cascade;
create table participaciones(
    id bigserial  constraint pk_participan primary key,

    id_participante bigint constraint fk_participaciones_participantes references participantes(id)
                            on delete no action on update cascade,

    id_rol bigint constraint fk_participaciones_roles references roles(id)
                        on delete no action on update cascade,

    id_pelicula bigint constraint fk_participaciones_peliculas references peliculas(id)
                            on delete no action on update cascade,

    id_genero bigint constraint fk_peliculas_genero references genero(id)
                            on delete no action on update cascade

);
