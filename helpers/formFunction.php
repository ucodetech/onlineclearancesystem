<?php 
	function formContainerOpen(){
		?>
			<div class="container shadow-lg bg-light" style="border-radius: 20px; padding: 10px;">
			
		<?
	}
function formContainerClose(){
		?>
			
			</div>
		<?
	}
	function formDivRowOpen(){
		?>
			<div class="row shadow-lg">
			
		<?
	}
	function formDivRowClose(){
		?>
			
			</div>
		<?
	}


	function formDivGroupOpen($grid){
		?>
			<div class="form-group <?=$grid;?>">
		
		<?
	}
	function formDivGroupClose(){
		?>
			
				
			</div>
		<?
	}
	function formOpen(){
		?>
			<form method="post" action="#">
		
		<?
	}
	function formClose(){
		?>
			
				
			</form>
		<?
	}

function formLabel($label){
	?>
		<label for=""><?=$label;?></label>
	<?
}

function formInput($type, $name, $id, $class, $placeholder=false){
	?>
		<input type="<?=$type?>" name="<?=$name?>" id="<?=$id?>" class="<?=$class?>" type="<?=$placeholder?>">
	<?
}
function formSelectOpen($name, $id, $class){
	?>
		<select name="<?=$name?>" id="<?=$id?>" class="<?=$class?>">
	
	<?
}
function formSelectClose(){
	?>
			
		</select>
	<?
}
function formOption($value,$text){
	?>
		<option value="<?=$value;?>"><?=$text;?></option>
	<?
}
function formButton($type, $name, $id, $class, $text){
	?>
		<button type="<?=$type?>" name="<?=$name?>" id="<?=$id?>" class="<?=$class?>"><?=$text;?></button>
	<?
}
function formHeader($header)
{
	?>
	<h3 class="text-center text-info text-lg"><?=$header;?></h3>
	<?
}