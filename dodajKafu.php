<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    
    
    <title>Dodaj kafu</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>



<style>
    body {
     
       background-image: url('./img/m.jpg');
       background-size: cover;
    }
</style>

<?php include 'header.php '; ?>



    <div class='container'>
        <div class='row mt-2 '>
            <h1>Dodaj novu kafu!</h1>

        </div>
        <div class='row mt-2' <?php echo (!isset($_GET['greska']))?'hidden':''; ?>>
            <h2 class='text-danger bg-light'>
                <?php echo $_GET['greska']; ?>
            </h2>
        </div>


        <div class="row mt-1 dodaj-kafu">
            <div class="col-7 bg-light ">
                <form name='forma' action="./server/kafa/create.php" method="post" enctype="multipart/form-data" size='200' onsubmit="return validacija()">
                    
               
                    <label>Naziv</label>
                    <input type="text" required class="form-control" name="naziv">
                    <label>Tezina</label>
                    <input type="number" required min="0" max="100" class="form-control" name="tezina">
                    <label>Ukus</label>
                    <input type="text" required class="form-control" name="ukus">
                    
                    <label>Marka</label>
                    <select id='marka' class="form-control" required name='marka_id'>

                    </select>
                    <label>Opis</label>
                    <textarea required name="opis" cols="30" rows="5" class="form-control">

                    </textarea>
                    <label>Slika</label>
                    <input type="file" required class="form-control" name="slika">
                    
                    <button class="form-control btn btn-primary mt-2 mb-2   dugme-pretraga ">Kreiraj kafu</button>
                </form>
            </div>
        </div>
    </div>




    <div class="container">
<br>
<br>
<div class="thumbnail_div">
<form method="post" action="get_thumbnail.php">
    <p>Ako nemate ideju koju sliku da uzmete probajte neki thumbnail sa youtuba ili url neke fotografije !</p>
<input  class="form-control" type="text" name="url" placeholder="Napisite URL youtube videa">
<input class="form-control dugme-pretraga " type="submit" name="get_thumbnail" value="PREUZMITE SLIKU SA  YOUTUBE VIDEA">
</form>


<br>


<div id="text_div">
 <form method="post" action="dajSliku.php">
  <input  class="form-control" type="text" name="img_url" placeholder="Unesite URL slike">
  <input  class="form-control dugme-pretraga "  type="submit" name="get_image" value="DODAJTE SLIKU U SVOJ RACUNAR">
 </form>
</div>


<br>
</div>
</div>



    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>





    <script>
    $(document).ready(function () {
        $.getJSON('./server/marka/returnAll.php', function (data) {
            console.log(data);
            if (!data.status) {
                alert(data.error);
                return;
            }

            for (let marka of data.kolekcija) {
                $('#marka').append(`
                    <option  value='${marka.id}'> ${marka.naziv} </option>
                `)
            }
          
        })
    })

	function validacija() {
  var n = document.forms["forma"]["naziv"].value;
  var t = document.forms["forma"]["tezina"].value;
  var u = document.forms["forma"]["ukus"].value;
  var m = document.forms["forma"]["marka_id"].value;
  var o = document.forms["forma"]["opis"].value;
  if (n == "" || o=="" || u=="" || m=="") {
    alert("Molimo Vas da popunite SVA polja!");
    return false;
  }
}
	
</script>

</body>
</html>