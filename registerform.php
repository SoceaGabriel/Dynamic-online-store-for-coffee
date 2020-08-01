<?php
  include "fisiereDeAdaugat/header.php";
?>
<div class="container" style="margin-top:70px;">
    <h1 class="well" id="creareContCard">Creaza cont</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form method="get" action="control/adaugautilizator_control.php">
					<div class="col-sm-12">
						<div class="row">
              <div class="col-sm-6 form-group">
								<label>Nume</label>
								<input type="text" placeholder="Introdu numele"  required="required" class="form-control" id="nume" name="nume">
						  </div>
						  <div class="col-sm-6 form-group">
								<label>Prenume</label>
								<input type="text" placeholder="Introdu prenumele"  required="required" class="form-control" id="prenume" name="prenume">
						  </div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Localitate</label>
								<input type="text" placeholder="Introduceti localitatea"  required="required" class="form-control" id="localitate" name="localitate">
							</div>
							<div class="col-sm-4 form-group">
								<label>Judet</label>
								<input type="text" placeholder="Introduceti judetul"  required="required" class="form-control" id="judet" name="judet">
							</div>
							<div class="col-sm-4 form-group">
								<label>Cod Postal</label>
								<input type="text" placeholder="introdu codul postal"  required="required" class="form-control" id="codPostal" name="codPostal">
							</div>
              </div>
              <div class="form-group">
							  <label>Adresa</label>
							  <textarea placeholder="introdu adresa" rows="3" class="form-control"  required="required" id="adresa" name="adresa"></textarea>
						  </div>
              <div class="form-group">
                <label>Telefon</label>
                <input type="number" placeholder="telefon" class="form-control"  required="required" id="telefon" name="telefon">
              </div>
              <div class="form-group">
                <label>Email </label>
                <input type="email" placeholder="Enter Email Address Here.."  required="required" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <label>Parola (minim 6 caractere)</label>
                <input type="password" placeholder="Introdu parola" pattern=".{6,}"  required="required"  class="form-control" id="parola" name="parola">
              </div>
              <button type="submit" name="adut" id="adut"  class="btn btn-lg btn-info">Submit</button>
            </div>
          </form>
				</div>
	     </div>
	    </div>
</body>
</html>
