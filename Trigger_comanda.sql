CREATE OR REPLACE TRIGGER monitorizare
    BEFORE DELETE ON COS_CUMPARATURI
    --WHEN (TO_DATE(NEW.SHIPDATE, 'DD-MON-YY')-TO_DATE(OLD.ORDERDATE, 'DD-MON-YY') < TO_DATE(OLD.SHIPDATE, 'DD-MON-YY')-TO_DATE(OLD.ORDERDATE, 'DD-MON-YY'))
DECLARE
    C_P COS_CUMPARATURI.PRODUSE_COD_PRODUS%TYPE := OLD.PRODUSE_COD_PRODUS;
BEGIN
    UPDATE PRODUSE SET NR_BUC_CURENTE = NR_BUC_CURENTE - OLD.NR_BUC 
                    WHERE COD_PRODUS = C_P;
END;
/

drop trigger monitorizare;