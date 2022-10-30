<script type="text/javascript">

$('#btn-valida-login').click(function() {
	var emailLogin = $('#emailLogin').val();
	var senhaLogin = $('#senhaLogin').val();

	var request = $.ajax({
		url: URL+"verificaLogin",
		method: "POST",
		data: { emailLogin: emailLogin, senhaLogin: senhaLogin },
		dataType: "json"
	});

	request.done(function( res ) {
		if (res.length > 0) {
			setTimeout(function () {
				location.href = URL+'dashboard';
			}, 300);
		} else {
			alert('Usuario ou senha inválido. Tente novamente ou entre em contato com o suporte.');
		}
	});

	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	});
});

</script>

</body>
</html>
