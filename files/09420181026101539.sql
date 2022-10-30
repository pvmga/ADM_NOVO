/*DELETE FROM COMISSAO_VEND_PROD
WHERE
	COMISSAO_VEND_PROD.COD_VENDEDOR = 129
GO*/

INSERT INTO COMISSAO_VEND_PROD
(
	COMISSAO_VEND_PROD.COD_VENDEDOR,
    COMISSAO_VEND_PROD.COD_PRODUTO,
    COMISSAO_VEND_PROD.PERCENTUAL,
    COMISSAO_VEND_PROD.TIPO_COMISSAO,
    COMISSAO_VEND_PROD.VALOR
)

SELECT 129, C.CODIGO, 1.0, 'P', 0 FROM CASHWIN_PURIFIC.DBO.CAD_IEST C
WHERE
	C.GRUPO IN (26,27,25,6,36) AND
    NOT EXISTS (
				SELECT * FROM COMISSAO_VEND_PROD CO
                WHERE
                	CO.COD_PRODUTO = C.CODIGO AND
                    CO.COD_VENDEDOR = 129
            )

GO

INSERT INTO COMISSAO_VEND_PROD
(
	COMISSAO_VEND_PROD.COD_VENDEDOR,
    COMISSAO_VEND_PROD.COD_PRODUTO,
    COMISSAO_VEND_PROD.PERCENTUAL,
    COMISSAO_VEND_PROD.TIPO_COMISSAO,
    COMISSAO_VEND_PROD.VALOR
)

SELECT 129, C.CODIGO, 1.0, 'P', 0 FROM CASHWIN_CARBON.DBO.CAD_IEST C
WHERE
	C.GRUPO IN (26,27,25,6,36) AND
    NOT EXISTS (
				SELECT * FROM COMISSAO_VEND_PROD CO
                WHERE
                	CO.COD_PRODUTO = C.CODIGO AND
                    CO.COD_VENDEDOR = 129
            )

GO
-- 1.0