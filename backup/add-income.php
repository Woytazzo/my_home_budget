<?php
session_start();
require_once "navbar.html";
?>
<article>	
<div class="container">	

	<div class="main-title">
	
		DODAJ PRZYCHÓD
	
	</div>
	
	<div class="income-container col-md-12">
	
	
	<div class="box col-md-3 amountDate">
			<fieldset class="field_set">
								
									<legend><b>KWOTA</b></legend>
									
								<input type="number" min="0.00"  step="0.01" name="money" class="inputAmountDate" />
									
								
								</fieldset>
								
								<fieldset class="field_set">
								
									<legend><b>DATA</b></legend>
							
									<input type="date" name="date" class="inputAmountDate" />
								
			</fieldset>
			</div>
			
			
			<div class="box col-md-5 category">
				<fieldset class="field_set">
								
									<legend class="name-of-area"><b>KATEGORIA</b></legend>
								
									<div><label> <input type="radio" value="1" name="przychod" checked> Wynagrodzenie </label></div> 
									<div><label> <input type="radio" value="2" name="przychod"> Odsetki bankowe </label></div> 
									<div><label> <input type="radio" value="3" name="przychod"> Sprzedaż na allegro </label></div> 
									<div><label> <input type="radio" value="4" name="przychod"> Inne </label></div>
								
				</fieldset>
			
			</div>
	
		<div class="box col-md-3 comment">
			
				<fieldset class="field_set ">
								
						<legend></legend>
									
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
require_once "footer.html"
?>