document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById("search_field").addEventListener("keyup", function(e) {
        if (this.value.trim().length > 0) {
            document.getElementById("search").disabled = false;
        } else {
            document.getElementById("search").disabled = true;
        }
    });
  });