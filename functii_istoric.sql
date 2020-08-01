
-----------------------------------------------PACHET TABELA ISTORIC COMENZI----------------------------------------------------
create or replace PACKAGE ISTORIC_FUNC IS

PROCEDURE INSERT_ISTORIC_ALL(NR_BUC_CMP IN ISTORIC_COMENZI.NR_BUCATI_CUMPARATE%TYPE, 
                            DATA_COM IN ISTORIC_COMENZI.DATA_COMANDA%TYPE, 
                            USER_ID IN ISTORIC_COMENZI.UTILIZATORI_ID_USER%TYPE, 
                            PROD_COS IN ISTORIC_COMENZI.PRODUSE_COD_PRODUS%TYPE,
                            ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE);

PROCEDURE UPDATE_NR_BUC(NR_BCT IN ISTORIC_COMENZI.NR_BUCATI_CUMPARATE%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_DATA_COM(DATA_C IN ISTORIC_COMENZI.DATA_COMANDA%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_ID_USER(ID_USR IN ISTORIC_COMENZI.UTILIZATORI_ID_USER%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_COD_PRODUS(COD IN ISTORIC_COMENZI.PRODUSE_COD_PRODUS%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_ID_COMANDA(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

TYPE RC_ISTORIC IS REF CURSOR;
PROCEDURE SELECT_COMENZI(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, CURS OUT RC_ISTORIC);

PROCEDURE SELECT_COMENZI_DETALII(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, CURS OUT RC_ISTORIC);

PROCEDURE CA_ULTIMA_LUNA_ISTORIC(REZ OUT NUMBER);

PROCEDURE MEDIU_PRODUSE_PRET(V_NR_BUC OUT NUMBER, V_ID_COM OUT NUMBER, V_PRET_TOT OUT NUMBER);

END ISTORIC_FUNC;
/

create or replace PACKAGE ISTORIC_FUNC IS

PROCEDURE INSERT_ISTORIC_ALL(NR_BUC_CMP IN ISTORIC_COMENZI.NR_BUCATI_CUMPARATE%TYPE, 
                            DATA_COM IN ISTORIC_COMENZI.DATA_COMANDA%TYPE, 
                            USER_ID IN ISTORIC_COMENZI.UTILIZATORI_ID_USER%TYPE, 
                            PROD_COS IN ISTORIC_COMENZI.PRODUSE_COD_PRODUS%TYPE,
                            ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE);

PROCEDURE UPDATE_NR_BUC(NR_BCT IN ISTORIC_COMENZI.NR_BUCATI_CUMPARATE%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_DATA_COM(DATA_C IN ISTORIC_COMENZI.DATA_COMANDA%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_ID_USER(ID_USR IN ISTORIC_COMENZI.UTILIZATORI_ID_USER%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_COD_PRODUS(COD IN ISTORIC_COMENZI.PRODUSE_COD_PRODUS%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

PROCEDURE UPDATE_ID_COMANDA(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, NR_CRT IN ISTORIC_COMENZI.NR_CURENT%TYPE);

TYPE RC_ISTORIC IS REF CURSOR;
PROCEDURE SELECT_COMENZI(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, CURS OUT RC_ISTORIC);

PROCEDURE SELECT_COMENZI_DETALII(ID_COM IN ISTORIC_COMENZI.ID_COMANDA%TYPE, CURS OUT RC_ISTORIC);

PROCEDURE CA_ULTIMA_LUNA_ISTORIC(REZ OUT NUMBER);

PROCEDURE MEDIU_PRODUSE_PRET(V_NR_BUC OUT NUMBER, V_ID_COM OUT NUMBER, V_PRET_TOT OUT NUMBER);

END ISTORIC_FUNC;
/
