<?php
session_start();
require_once "navbar.html"
?>

<article>	
<div class="container">	

	<div class="main-title">
	
		DODAJ WYDATEK
	
	</div>
	
	<div class="income-container col-md-12">
	
	<div class="box3 col-md-3 amountDate">
			<fieldset class="field_set">
								
									<legend><b>KWOTA</b></legend>
									
								<input type="number" min="0.00"  step="0.01" name="money" class="inputAmountDate" />
									
								
			</fieldset>
								
			<fieldset class="field_set">
								
									<legend><b>DATA</b></legend>
							
									<input type="date" name="date" class="inputAmountDate" />
								
			</fieldset>
			
			<fieldset class="field_set">
			
			<legend><b>SPOSÓB ZAPŁATY</b></legend>
								
									<select id="way-of-payment">
										<option>Gotówka</option>
										<option>Karta debetowa</option>
										<option>Karta kredytowa</option>
									</select>
			</fieldset>						
									
			</div>
			
			
			<div class="box2 col-md-5 category">
				<fieldset class="field_set">
								
									<legend class="name-of-area"><b>KATEGORIA</b></legend>
								
									<div class="column col-xs-6">
										<div><label> <input type="radio" value="1" name="wydatek" > Jedzenie </label></div> 
										<div><label> <input type="radio" value="2" name="wydatek"> Mieszkanie </label></div> 
										<div><label> <input type="radio" value="3" name="wydatek"> Transport </label></div> 
										<div><label> <input type="radio" value="4" name="wydatek"> Telekomunikacja </label></div>
										<div><label> <input type="radio" value="5" name="wydatek"> Opieka zdrowotna </label></div>
										<div><label> <input type="radio" value="6" name="wydatek"> Ubranie </label></div>
										<div><label> <input type="radio" value="7" name="wydatek"> Higiena </label></div>
										<div><label> <input type="radio" value="8" name="wydatek"> Dzieci </label></div>
										<div><label> <input type="radio" value="9" name="wydatek"> Rozrywka </label></div>
									</div>
									
					
									<div class="column col-xs-6">
									<div><label> <input type="radio" value="10" name="wydatek"> Wycieczka </label></div>
										<div><label> <input type="radio" value="11" name="wydatek"> Szkolenia </label></div>
										<div><label> <input type="radio" value="12" name="wydatek">  Książki </label></div>
										<div><label> <input type="radio" value="13" name="wydatek"> Oszczędności </label></div>
										<div><label> <input type="radio" value="14" name="wydatek">  Złota jesień </label></div>
										<div><label> <input type="radio" value="15" name="wydatek"> Spłata długów </label></div>
										<div><label> <input type="radio" value="16" name="wydatek"> Darowizna </label></div>
										<div><label> <input type="radio" value="17" name="wydatek"> Inne </label></div>
									</div>
								
				</fieldset>
			
			</div>
	
		<div class="box col-md-3 comment">
			
				<fieldset class="field_set ">
								
						<legend><b>KOMENTARZ</b></legend>
									
							<label><br/>
								<textarea placeholder="Dodaj komentarz..." class=" textinput" ></textarea>
							</label><br/>
								
				</fieldset>
			
		</div>
	
	</div>
	
	<div class="row col-12">
			<div class="submitBox">
				<input type="submit" value="Dodaj">
				<input type="button" id="anuluj" value="Anuluj">
			</div>
	</div>
	
</div>
</article>
<?php
require_once "footer.html";
?>