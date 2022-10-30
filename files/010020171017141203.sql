SELECT 
    C.USER_SMTP,
    C.PORT_SMTP, 
    C.SENHA_EMAIL_USUARIO,
    C.SERVER_SMTP_USUARIO,*
    
/*UPDATE C SET C.USER_SMTP = 'araucaria041@araucaria-ar.com.br', 
			 C.SENHA_EMAIL_USUARIO = '$Ara$4372138',
			 C.PORT_SMTP = 587,
             C.SERVER_SMTP_USUARIO = 'smtp.araucaria-ar.com.br'*/
FROM CAD_USUA C
WHERE
	C.USER_SMTP IS NOT NULL