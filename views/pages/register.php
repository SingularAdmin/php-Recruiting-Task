<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('Users/create'); ?>
	<div class="form-group">
		<span class="label label-default"> Ονοματεπώνυμο</span>
		<input type="text" class="form-control" name="name" placeholder="Ονοματεπώνυμο">
	</div>
	<div class="form-group">
		<span class="label label-default">Όνομα Χρήστη</span>
		<input type="text" class="form-control" name="usernames" placeholder="Όνομα Χρήστη">
	</div>
	<div class="form-group">
		<span class="label label-primary">Κωρικός</span>
		<input type="Password" class="form-control" name="passwd" placeholder="Κωδικός">
	</div>
	<div class="form-group">
		<span class="label">Επανάληψη κωδικού</span>
		<input type="Password" class="form-control" name="passwd1" placeholder="Επανάληψη κωδικού">
	</div>
	<div class="form-group">
		<span class="label">E-mail</span>
		<input type="email" class="form-control" name="email" placeholder="E-mail">
	</div>

	<div id="Roles"></div>
	<BR>
	<button type="submit" class="btn btn-primary">Submit</button>
		<script type="text/javascript">
			getRoles();
 	 	</script>
<?php echo form_close(); ?>