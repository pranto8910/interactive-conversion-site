
    function jsValid() 
    { 
  
        var Catagory = document.forms["HomeForm"]["Catagory"].value;
        var value = document.forms["HomeForm"]["value"].value;
  
 
        if (Catagory === "" ) 
        {
            document.getElementById('CatagoryErr').innerHTML = "Catagory can not be empty.";
            return false;
        } 

        if (value === "" || isNaN(value)) 
        {
            document.getElementById('valueErr').innerHTML = "Value can not be empty or non numeric.";
            return false;
        } 

        
 
    }
         function fetch( )
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                console.log(this.readyState);
                if(this.readyState === 4 && this.status === 200) // if all done
                {
                     // console.log(this.responseText);//console output
                    document.getElementById('result').innerHTML = this.responseText * document.forms["HomeForm"]["value"].value;

                }
            }
            var Catagory = document.forms["HomeForm"]["Catagory"].value;
            xhttp.open("GET","homeAction.php?catagory=Catagory",true); 
            xhttp.send(); 


 
        }
     


 