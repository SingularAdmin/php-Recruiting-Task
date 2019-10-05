<p id="testP"></p> <!-- PAGE FOR DEBUGGING-->
<script type="text/javascript">
      $.ajax({
    type: 'POST',
    contentType: "application/json;charset=ISO-8859-15",
    url: "<?php echo base_url(); ?>Users/read",
    dataType: 'json',
    success: function(data){
      let result = JSON.parse(data);
      $("#testP").append(result[0].name);
    },  
    error: function(e) {
        console.log("error: ",e);
    }
  });
</script>