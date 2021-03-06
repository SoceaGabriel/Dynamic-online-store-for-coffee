
-----------------------------------------------PACHET TABELA COS CUMPARATURI----------------------------------------------------
CREATE OR REPLACE PACKAGE COS_FUNC IS

PROCEDURE INSERT_COS_ALL(NR_BCT IN COS_CUMPARATURI.NR_BUC%TYPE, 
                        USER_ID IN COS_CUMPARATURI.utilizatori_id_user%TYPE, 
                        PROD_COS IN COS_CUMPARATURI.produse_cod_produs%TYPE,
                        DAT IN COS_CUMPARATURI.data_adaugare%TYPE);

PROCEDURE UPDATE_NR_BUC(NR_BCT IN COS_CUMPARATURI.NR_BUC%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE);

PROCEDURE UPDATE_ID_USER(ID_USR IN COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE);

PROCEDURE UPDATE_COD_PROD(COD IN COS_CUMPARATURI.PRODUSE_COD_PRODUS%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE);

PROCEDURE UPDATE_DATA_ADAUGARE(DAT IN COS_CUMPARATURI.DATA_ADAUGARE%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE);

PROCEDURE DELETE_ROW(COD_PROD IN COS_CUMPARATURI.PRODUSE_COD_PRODUS%TYPE, ID_USER IN COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE, DAT IN COS_CUMPARATURI.DATA_ADAUGARE%TYPE);

END COS_FUNC;
/

CREATE OR REPLACE PACKAGE BODY COS_FUNC IS

PROCEDURE INSERT_COS_ALL(NR_BCT IN COS_CUMPARATURI.NR_BUC%TYPE, 
                        USER_ID IN COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE, 
                        PROD_COS IN COS_CUMPARATURI.PRODUSE_COd_PRODUS%TYPE,
                        DAT IN COS_CUMPARATURI.data_adaugare%TYPE) IS
BEGIN
    INSERT INTO COS_CUMPARATURI(NR_BUC, UTILIZATORI_ID_USER, PRODUSE_COD_PRODUS, DATA_ADAUGARE) VALUES(NR_BCT, USER_ID, PROD_COS, DAT);
END INSERT_COS_ALL; 

PROCEDURE UPDATE_NR_BUC(NR_BCT IN COS_CUMPARATURI.NR_BUC%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE) IS
BEGIN
    UPDATE COS_CUMPARATURI SET NR_BUC = NR_BCT WHERE NR_CURENT = NR_CRT;
END UPDATE_NR_BUC;

PROCEDURE UPDATE_ID_USER(ID_USR IN COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE) IS
BEGIN
    UPDATE COS_CUMPARATURI SET UTILIZATORI_ID_USER = ID_USR WHERE NR_CURENT = NR_CRT;
END UPDATE_ID_USER;

PROCEDURE UPDATE_COD_PROD(COD IN COS_CUMPARATURI.PRODUSE_COD_PRODUS%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE) IS
BEGIN
    UPDATE COS_CUMPARATURI SET PRODUSE_COD_PRODUS = COD WHERE NR_CURENT = NR_CRT;
END UPDATE_COD_PROD;

PROCEDURE UPDATE_DATA_ADAUGARE(DAT IN COS_CUMPARATURI.DATA_ADAUGARE%TYPE, NR_CRT IN COS_CUMPARATURI.NR_CURENT%TYPE) IS
BEGIN
    UPDATE COS_CUMPARATURI SET DATA_ADAUGARE = DAT WHERE NR_CURENT = NR_CRT;
END UPDATE_DATA_ADAUGARE;


PROCEDURE DELETE_ROW(COD_PROD IN COS_CUMPARATURI.PRODUSE_COD_PRODUS%TYPE, ID_USER IN COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE, DAT IN COS_CUMPARATURI.DATA_ADAUGARE%TYPE) IS
    --MAXIM COS_CUMPARATURI.UTILIZATORI_ID_USER%TYPE;
BEGIN
    DELETE FROM COS_CUMPARATURI WHERE PRODUSE_COD_PRODUS = COD_PROD AND UTILIZATORI_ID_USER = ID_USER AND DATA_ADAUGARE = DAT; --STERGEM RANDUL
    --SELECT MAX(NR_CURENT) INTO MAXIM FROM COS_CUMPARATURI; --AFLAM MAXIMUL 
    --ALTER TABLE COS_CUMPARATURI AUTO_INCREMENT := MAXIM +1; --RESETAM AUTOINCREMENTUL
END DELETE_ROW;

END COS_FUNC;
/
