--testare functii din functii_produse.sql
EXECUTE PRODUSE_FUNC.INSERT_PRODUSE_ALL('JJ Darboven Intencion Espresso', 'cafea_boabe', 'intens', 'JJ Darboven Intencion Ecologico Espresso Fairtrade este o cafea ideala pentru prepararea la automatele de cafea si la espressoarele clasice, cu o aroma deosebita, certificata ecologic, recomandata pentru un espresso savuros, cu o aroma intensa, crema placuta si note picante.', 59, 1000, 0, 0, 20, 0, 'no', 0, 0);

SELECT * FROM PRODUSE;

execute produse_func.delete_row_cod_produs(1002);

EXECUTE PRODUSE_FUNC.INSERT_PRODUSE_NOT_NULL('Bazzara Miscela PiacerePuro', 'cafea_boabe', 'slab', 145, 1000, 30, 0, 'no');

EXECUTE produse_func.update_nume_cafea('Bazzara Miscela', 1004);

EXECUTE produse_func.update_promotie('yes', 1004);


--testare functii din functii_UTILIZATORI.sql
EXECUTE utilizatori_func.insert_utilizatori_all('GABRIEL', 'SOCEA', '123456789', 'admin', '0748652437', 'socea.gabi@gmailll.com', 'REDIU','NEAMT','0987654','STRADA COSERELOR, NR.20 COM. REDIU');

select * from utilizatori;

execute utilizatori_func.update_email('socea.gabitzu@yahoo.com', 11030);

execute utilizatori_func.delete_row_id_utilizator(11030);


--testare functii din functii_COS_CUMPARATURI.sql
EXECUTE COS_FUNC.INSERT_COS_ALL(24, 11005, 1003,TO_DATE('2019/11/22 21:02:44', 'yyyy/mm/dd hh24:mi:ss'));

SELECT NR_BUC, utilizatori_id_user, produse_cod_produs, TO_CHAR(data_adaugare, 'yyyy/mm/dd hh24:mi:ss') FROM COS_CUMPARATURI;

EXECUTE cos_func.update_nr_buc(5, 1);

EXECUTE cos_func.delete_row_cod_produs(1003);


--testare functii din functii_ISTORIC.sql

EXECUTE istoric_func.insert_istoric_all(2, TO_DATE('2019/11/22 23:22:45', 'yyyy/mm/dd hh24:mi:ss'), 11005, 1003,123);

SELECT NR_CURENT, NR_BUCATI_CUMPARATE, TO_CHAR(DATA_COMANDA, 'yyyy/mm/dd hh24:mi:ss'), UTILIZATORI_ID_USER, PRODUSE_COD_PRODUS, ID_COMANDA FROM ISTORIC_COMENZI;

EXECUTE istoric_func.update_nr_buc(3,1);


--testare functii din functii_comenzi_crt.sql
EXECUTE com_crt_func.insert_comenzi_crt_all(11005, 'comanda_neprocesata', TO_DATE('2019/11/23 23:08:45', 'yyyy/mm/dd hh24:mi:ss'));

SELECT ID_COMANDA, ID_USER, STATUS_COMANDA, TO_CHAR(DATA_COMANDA, 'yyyy/mm/dd hh24:mi:ss') FROM COMENZI_CURENTE;

EXECUTE  com_crt_func.UPDATE_DATA_COMANDA(TO_DATE('2019/11/18 15:20:05', 'yyyy/mm/dd hh24:mi:ss'), 101);

EXECUTE com_crt_func.delete_row(102);


--testare functii din functii_produse_comanda.sql

EXECUTE prod_com_func.insert_produse_comanda_all(1004, 5, 100);

SELECT * FROM produse_comanda;

EXECUTE prod_com_func.UPDATE_ID_COMANDA(101,2);

EXECUTE prod_com_func.DELETE_ROW_ID_COMANDA(100, 1004);

--testare functii din functii_produse_comanda.sql

EXECUTE PATH_IMG_FUNC.INSERT_PATH_ALL('C://DESKTOP/IMAGINI/IMG_ARGENTINA.JPG','TEXT ALT', 'CAFEA DAVID OFF', 1003);

SELECT * FROM PATH_IMAGINI;

EXECUTE PATH_IMG_FUNC.UPDATE_PATH('C://DESKTOP/IMAGINI/IMG_ARGENTINA_CAFFE_PREMIUM.JPG', 1);

EXECUTE path_img_func.delete_row(20);

select * from COMENZI_CURENTE;
SELECT * FROM produse_comanda;
select * from istoric_comenzi;
commit;
delete from istoric_comenzi where id_comanda = 114;

select sum(pret_total) from produse_comanda;

EXECUTE PRODUSE_FUNC.INSERT_PRODUSE_ALL('kllllllllllllllllllk', 'cafea_boabe', 'intens', 'JJ Darboven Intencion Ecologico Espresso Fairtrade este o cafea ideala pentru prepararea la automatele de cafea si la espressoarele clasice, cu o aroma deosebita, certificata ecologic, recomandata pentru un espresso savuros, cu o aroma intensa, crema placuta si note picante.', 59, 1000, 0, 0, 20, 0, 'no', 0, TO_DATE('2019/11/24','yyyy/mm/dd'));


select add_months(sysdate,-1) from dual;

delete from istoric_comenzi where id_comanda = 111;
commit;


EXECUTE com_crt_func.insert_comenzi_crt_all(11011, 'comanda_neprocesata', TO_DATE('2019/12/11 14:08:15', 'yyyy/mm/dd hh24:mi:ss'), 3);
EXECUTE com_crt_func.insert_comenzi_crt_all(11014, 'comanda_neprocesata', TO_DATE('2019/11/08 15:12:25', 'yyyy/mm/dd hh24:mi:ss'), 1);
EXECUTE com_crt_func.insert_comenzi_crt_all(11016, 'comanda_neprocesata', TO_DATE('2019/10/05 16:18:35', 'yyyy/mm/dd hh24:mi:ss'), 2);
EXECUTE com_crt_func.insert_comenzi_crt_all(11019, 'comanda_neprocesata', TO_DATE('2019/07/27 20:12:45', 'yyyy/mm/dd hh24:mi:ss'), 5);
EXECUTE com_crt_func.insert_comenzi_crt_all(11020, 'comanda_neprocesata', TO_DATE('2019/12/18 08:35:55', 'yyyy/mm/dd hh24:mi:ss'), 6);
EXECUTE com_crt_func.insert_comenzi_crt_all(11021, 'comanda_neprocesata', TO_DATE('2019/09/14 06:48:05', 'yyyy/mm/dd hh24:mi:ss'), 4);
EXECUTE com_crt_func.insert_comenzi_crt_all(11017, 'comanda_neprocesata', TO_DATE('2019/10/30 12:56:18', 'yyyy/mm/dd hh24:mi:ss'), 2);
EXECUTE com_crt_func.insert_comenzi_crt_all(11015, 'comanda_neprocesata', TO_DATE('2019/12/21 18:23:43', 'yyyy/mm/dd hh24:mi:ss'), 1);
EXECUTE com_crt_func.insert_comenzi_crt_all(11011, 'comanda_neprocesata', TO_DATE('2019/11/20 17:54:07', 'yyyy/mm/dd hh24:mi:ss'), 2);
EXECUTE com_crt_func.insert_comenzi_crt_all(11019, 'comanda_neprocesata', TO_DATE('2019/10/22 14:15:41', 'yyyy/mm/dd hh24:mi:ss'), 1);

EXECUTE prod_com_func.insert_produse_comanda_all(1030, 1, 123, 26);
EXECUTE prod_com_func.insert_produse_comanda_all(1029, 1, 123, 75);
EXECUTE prod_com_func.insert_produse_comanda_all(1021, 1, 123, 17);
EXECUTE prod_com_func.insert_produse_comanda_all(1015, 1, 124, 20);
EXECUTE prod_com_func.insert_produse_comanda_all(1014, 2, 124, 55);
EXECUTE prod_com_func.insert_produse_comanda_all(1016, 2, 124, 20);
EXECUTE prod_com_func.insert_produse_comanda_all(1017, 1, 121, 20);
EXECUTE prod_com_func.insert_produse_comanda_all(1022, 1, 121, 14);
EXECUTE prod_com_func.insert_produse_comanda_all(1024, 1, 121, 15);
EXECUTE prod_com_func.insert_produse_comanda_all(1023, 1, 122, 24);
EXECUTE prod_com_func.insert_produse_comanda_all(1010, 3, 125, 47);
EXECUTE prod_com_func.insert_produse_comanda_all(1026, 2, 125, 18);
EXECUTE prod_com_func.insert_produse_comanda_all(1011, 1, 125, 24);
EXECUTE prod_com_func.insert_produse_comanda_all(1012, 2, 126, 48);
EXECUTE prod_com_func.insert_produse_comanda_all(1013, 2, 126, 37);
EXECUTE prod_com_func.insert_produse_comanda_all(1018, 1, 127, 21);
EXECUTE prod_com_func.insert_produse_comanda_all(1019, 1, 127, 51);
EXECUTE prod_com_func.insert_produse_comanda_all(1020, 1, 128, 45);
EXECUTE prod_com_func.insert_produse_comanda_all(1025, 1, 129, 23);
EXECUTE prod_com_func.insert_produse_comanda_all(1026, 1, 129, 18);
EXECUTE prod_com_func.insert_produse_comanda_all(1024, 1, 130, 15);
commit;


DELETE FROM PRODUSE_COMANDA WHERE COMENZI_CURENTE_ID_COMANDA = 130;
commit;


SELECT ID_COMANDA, ID_USER, STATUS_COMANDA, TO_CHAR(DATA_COMANDA, 'yyyy/mm/dd hh24:mi:ss') FROM COMENZI_CURENTE;


SET SERVEROUTPUT ON
VARIABLE SMA NUMBER;
EXECUTE COM_CRT_FUNC.CA_ULTIMA_LUNA(:SMA);
PRINT SMA;

SET SERVEROUTPUT ON
VARIABLE SMA_1 NUMBER;
EXECUTE ISTORIC_FUNC.CA_ULTIMA_LUNA_ISTORIC(:SMA_1);
PRINT SMA_1;


SET SERVEROUTPUT ON
VARIABLE SMA_S NUMBER;
VARIABLE SMA_C NUMBER;
EXECUTE ISTORIC_FUNC.MEDIU_PRODUSE_PRET(:SMA_S, :SMA_C);
PRINT SMA_S;
PRINT SMA_C;


execute UTILIZATORI_FUNC.UPDATE_NR_COMENZI(3,11009);

EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11016);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11019);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11011);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11021);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11017);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11011);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11019);
EXECUTE UTILIZATORI_FUNC.UPDATE_NR_COMENZI(1,11018);
commit;