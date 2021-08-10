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

            var Catagory = document.forms["HistoryForm"]["Catagory"].value;
            
 
            xhttp.open("GET","indexAction.php?Catagory=Catagory",true);//type,where,asyncronous(true) or syncronous(false) ?username=arafat is query for seardch data. to add more query add &
            xhttp.send();//send when readystate done


 
        }
  