
    <?php include('fisiereDeAdaugat/header.php');
      session_start();
    ?>
    <p><br/><p>
    <p><br/><p>
    <p><br/><p>
    <div class="container-fluid" style="padding-bottom:390px;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="mesaj_cos"></div>
            <div class="col-md-8"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Cosul de cumparaturi</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 col-xs-2"><b>Actiune</b></div>
                            <div class="col-md-2 col-xs-2"><b>Imagine</b></div>
                            <div class="col-md-2 col-xs-2"><b>Nume produs</b></div>
                            <div class="col-md-2 col-xs-2"><b>Cantitate</b></div>
                            <div class="col-md-2 col-xs-2"><b>Pret</b></div>
                            <div class="col-md-2 col-xs-2"><b>Pret total</b></div>
                        </div>
                        <div id="cos_de_cumparaturi"></div>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <?php include('fisiereDeAdaugat/footer_min.php');?>
