
    function jsValid() 
    { 
  
        var Catagory = document.forms["ConversionRateForm"]["Catagory"].value;
        var Unit = document.forms["ConversionRateForm"]["Unit"].value;
        var Rate = document.forms["ConversionRateForm"]["Rate"].value;
 
 
        if (Catagory === "" ) 
        {
            document.getElementById('CatagoryErr').innerHTML = "Catagory can not be empty.";
            return false;
        } 

        if (Unit === ""  || isNaN(Unit) ) 
        {
            document.getElementById('UnitErr').innerHTML = "Unit can not be empty or non numeric.";
            return false;
        } 

        if (Rate === ""  || isNaN(Rate)) 
        {
            document.getElementById('RateErr').innerHTML = "Rate can not be empty or non numeric.";
            return false;
        } 
 
    }



         function fetch()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                console.log(this.readyState);
                if(this.readyState === 4 && this.status === 200) // if all done
                {
                     // document.getElementById('demo').innerHTML = this.responseText;

                }
            }


            var Catagory = document.forms["ConversionRateForm"]["Catagory"].value;
            var Unit = document.forms["ConversionRateForm"]["Unit"].value;
            var Rate = document.forms["ConversionRateForm"]["Rate"].value;
     
 
            xhttp.open("GET","indexAction.php?Catagory=Catagory&Unit=Unit&Rate=Rate",true);//type,where,asyncronous(true) or syncronous(false) ?username=arafat is query for seardch data. to add more query add &
            xhttp.send();//send when readystate done


 
        }
  