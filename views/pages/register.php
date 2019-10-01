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
 	 		$.ajax({
  			  type: 'POST',
			  contentType: "application/json;charset=ISO-8859-15",
			  url: "<?php echo base_url(); ?>Users/read_roles",
			  dataType: 'json',
			  success: function(data){
			  	let objRoles = JSON.parse(data);
				$(objRoles).each(function(index){
			  		let divR = $('<div/>');
			  		divR.addClass("custom-control custom-checkbox");

			  		let checkR = $('<input/>');
			  		checkR.attr('type','checkbox');
			  		checkR.addClass("custom-control-input");
			  		checkR.attr('id',index);

			  		let labelR = $('<label></label>');
			  		labelR.addClass("custom-control-label");
			  		labelR.attr('for', index);
			  		labelR.text(objRoles[index].name);

			  		divR.append(checkR);
			  		divR.append(labelR);

			  		divR.appendTo("#Roles");
			  	});
			  	
			  },  
			  error: function(e) {
			      console.log("error: ",e);
			  }
			});
 	 	</script>
 	 	<p id='testP'></p>
<?php echo form_close(); ?>