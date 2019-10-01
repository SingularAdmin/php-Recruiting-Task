<table class="table" id="usersTable">
  <thead>
    <tr>
      <th scope="Name">Όνομα</th>
      <th scope="Username">Όνομα Χρήστη</th>
      <th scope="prev">Δικαιώματα</th>
      <th scope="on">Ενεργός</th>
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>
<p id="testP"></p>
<!--
<script type='text/javascript' src="<?php echo base_url(); ?>js/ajax.js">
  loadUserTable();
</script>
-->
<script type="text/javascript">
      $.ajax({
    type: 'POST',
    contentType: "application/json;charset=ISO-8859-15",
    url: "<?php echo base_url(); ?>Users/read",
    dataType: 'json',
    success: function(data){
      $("#usersTable").DataTable(data);
    },  
    error: function(e) {
        console.log("error: ",e);
    }
  });
</script>

