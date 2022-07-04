<script>
        $(document).ready(function(){
  $("#flexSwitchCheckDefault").mouseup(function(){ 
    event.preventDefault();
    var searchvalues=$("#searchfield").val();
    $.get("livesearch.php",{keys: searchvalues} ,function(data,status){
        //This means that change the html of Areas and put the html intos the area which is recieved through the data parameter of the Callback Functions SWG
       $("#liveareas").html(data);    
       
       
    })
  });
});


    </script>