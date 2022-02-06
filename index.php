<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Kafeterija</title>
</head>

<body>


<?php include 'header.php'; ?>

<style>
    body {
     
       background-image: url('./img/coffee.jpg');
       background-size: cover;
    }
</style>

<div class="container">
        <div class=" row mt-2 poz">
            <div class="col-3 ">
                <select id='sort' class="form-control">
                    <option value="">Sortiraj po nazivu</option>
                    <option value="ASC">Sortiraj rastuce</option>
                    <option value="DESC">Sortiraj opadajuce</option>
                </select>
            </div>
           
            <div class="col-3">
                <select id='marka' class="form-control">
                    <option value="0">Filtriraj po marki</option>

                </select>
            </div>
            <div class="col-6">
                <input type="text" id='naziv' onkeyup="showHint(this.value)" class="form-control " placeholder="Filtriraj po nazivu">
                <p> <span id="txtHint"></span> </p>
            </div>
        </div>
        <div id='elementi'>

        </div>
    </div>

   <script src="https://code.jquery.com/jquery-3.6.0.js" 
    ></script>


    <script>
        let kafe = [];
        $(document).ready(function () {
            $.getJSON('./server/kafa/returnAll.php', function (data) {
               
                if (data.status == 'false') {
                    alert(data.error);
                    return;
                } else {
                    kafe= data.kolekcija;
                    ispisi();
                }

            });
            $.getJSON('./server/marka/returnAll.php', function (data) {

                if (!data.status) {
                    alert(data.error);
                    return;
                }

                for (let marka of data.kolekcija) {
                    $('#marka').append(`
                        <option value='${marka.id}'> ${marka.naziv} </option>
                    `)
                }
            })

            $('#marka').change(function () {
                ispisi();
            })
            $('#sort').change(function () {
                ispisi();
            })
            $('#naziv').change(function () {
                ispisi();
            })

        })
        function ispisi() {
            const marka = $('#marka').val();
            const sort = $('#sort').val();
            const imeFilter = $('#naziv').val();
            const niz = kafe.filter(element => {
                return (marka == 0 || element.marka_id == marka) && element.naziv.startsWith(imeFilter) 

                
            })
            niz.sort((a, b) => {
                if (sort == 'ASC')
                    return (a.naziv.toLowerCase() > b.naziv.toLowerCase()) ? 1 : -1;
                return (a.naziv.toLowerCase() > b.naziv.toLowerCase()) ? -1 : 1;
            });

            let red = 0;
            let kolona = 0;
            $('#elementi').html(`<div id='row-${red}' class='row mt-2'></div>`)
            for (let kafa of niz) {
                if (kolona === 4 ) {
                    kolona = 0;
                    red++;
                    $('#elementi').append(`<div id='row-${red}' class='row mt-2'></div>`)
                }
                $(`#row-${red}`).append(
                    `
                        <div class='col-3 pt-2 bg-light'>
                            <img src='${kafa.slika}' />
                            <h4 class='text-center'>${kafa.naziv}</h4>
                            <h5 class='text-center'>${kafa.marka_id}</h5>  
                            
                        </div>
                    `
                ) 
            }
        }

        <!--AJAX funkcija-->
	
          function showHint(str) {
          var xhttp;
          if (str.length == 0) { 
            document.getElementById("txtHint").innerHTML = "";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "ajaxSuggest.php?q="+str, true);
          xhttp.send();   
        }
 



    </script>
    

 
</body>

</html>