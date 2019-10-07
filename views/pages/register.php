<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('Users/create'); ?>
	<div class="form-group">
		<span class="label label-default"> Ονοματεπώνυμο</span>
		<input type="text" class="form-control" name="name" placeholder="Ονοματεπώνυμο">
	</div>
	<div class="form-group">
		<span class="label label-default">Όνομα Χρήστη</span>
		<input type="text" class="form-control" name="username" placeholder="Όνομα Χρήστη">
	</div>
	<div class="form-group">
		<span class="label label-primary">Κωδικός</span>
		<input type="Password" class="form-control" name="passwd" placeholder="Κωδικός">
	</div>
	<div class="form-group">
		<span class="label">Επανάληψη κωδικού</span>
		<input type="Password" class="form-control" name="passconf" placeholder="Επανάληψη κωδικού">
	</div>
	<div class="form-group">
		<span class="label">E-mail</span>
		<input type="email" class="form-control" name="email" placeholder="E-mail">
	</div>

	<div id="Roles"></div>
	<BR>
	<script type="text/javascript">
			let selected = [];
			setRoles();
			$('#Roles').change(function() {
			selected = getSelectedRoles();
			//alert(JSON.stringify(selected));
		});
			/*
			$(setRoles()).promise().done(function(){
				selected = getSelectedRoles();
				alert(selected);
			});
			*/
			jsonObj = JSON.stringify(selected);
		
			
 	</script>
 	
 	<input type="hidden" name="selectedRoles" value=jsonObj/>
	<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>