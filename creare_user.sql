CREATE USER magazin_cafea IDENTIFIED BY cafea
DEFAULT TABLESPACE users
TEMPORARY TABLESPACE temp
QUOTA UNLIMITED ON users;
GRANT connect , resource , create view TO magazin_cafea;