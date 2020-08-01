select * from produse;

select * from path_imagini;

select * from utilizatori;

select * from cos_cumparaturi;

select * from istoric_comenzi;

select * from comenzi_curente order by id_comanda;

select * from produse_comanda order by comenzi_curente_id_comanda;


execute cos_func.INSERT_COS_ALL(2, 11009, 1010);
