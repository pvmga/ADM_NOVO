<!-- Page level plugins -->
<!--<script src="<?= base_url('template/'); ?>vendor/chart.js/Chart.min.js"></script>-->

<!-- Page level custom scripts -->
<!--<script src="<?= base_url('template/'); ?>js/demo/chart-area-demo.js"></script>-->
<!--<script src="<?= base_url('template/'); ?>js/demo/chart-pie-demo.js"></script>-->
<script type="text/javascript">
    
    var request = $.ajax({
        url: URL + "buscarDadosDashboard",
        method: "GET",
        dataType: "json",
        cache: false,
    });

    request.done(function (res) {
        console.log(res);
        document.querySelector('#status_1').textContent = res.aguardando[0]['quantidade'];
        document.querySelector('#status_2').textContent = res.confirmadas[0]['quantidade'];
        document.querySelector('#status_3').textContent = res.atualizar[0]['quantidade'];
        document.querySelector('#status_4').textContent = res.resolvidas[0]['quantidade'];
    });

    request.fail(function (jqXHR, textStatus) {
        console.log("Request failed - (buscarDadosDashboard): " + textStatus, jqXHR);
    });

</script>

</body>
</html>
