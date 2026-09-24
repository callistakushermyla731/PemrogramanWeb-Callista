-- jalankan bagian CREATE DATABASE terlebih dahulu dari database bawaan PostgreSQL
create database digirent;

-- setelah masuk ke database digirent, jalankan bagian di bawah ini

create table if not exists digicam (
    id serial primary key,
    nama varchar(150) not null,
    merek varchar(100) not null,
    tipe varchar(100) not null,
    harga_sewa integer not null check (harga_sewa >= 0),
    stok integer not null check (stok >= 0)
);

create table if not exists pelanggan (
    id serial primary key,
    nama varchar(150) not null,
    email varchar(150) not null,
    no_hp varchar(30) not null,
    alamat text not null
);

insert into digicam (nama, merek, tipe, harga_sewa, stok)
select 'Canon IXUS 185', 'Canon', 'Compact Camera', 75000, 3
where not exists (select 1 from digicam);

insert into digicam (nama, merek, tipe, harga_sewa, stok)
select 'Sony Cyber-shot DSC-W830', 'Sony', 'Compact Camera', 80000, 2
where not exists (select 1 from digicam where nama = 'Sony Cyber-shot DSC-W830');

insert into digicam (nama, merek, tipe, harga_sewa, stok)
select 'Fujifilm FinePix JX500', 'Fujifilm', 'Compact Camera', 70000, 4
where not exists (select 1 from digicam where nama = 'Fujifilm FinePix JX500');

insert into pelanggan (nama, email, no_hp, alamat)
select 'Callista', 'callista@gmail.com', '081234567890', 'Malang'
where not exists (select 1 from pelanggan);

insert into pelanggan (nama, email, no_hp, alamat)
select 'Dimas', 'dimas@gmail.com', '082345678901', 'Blitar'
where not exists (select 1 from pelanggan where email = 'dimas@gmail.com');
