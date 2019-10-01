var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var myObj = JSON.parse(this.responseText);
    alert("sd");
  }
};
xmlhttp.open("GET", "display.php", true);
xmlhttp.send(); 