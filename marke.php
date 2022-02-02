<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Marke</title>
  
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


</head>

<style>
    body {
     
       background-image: url('./img/marke1.jpg');
       background-size: cover;
    }
</style>

<body>
<?php include 'header.php '; ?>
    <div class='container'>
        <div class='row mt-2'>
            <div class='col-7'>
                <table class='table table-light display'>
                    <thead>
                        <tr>
                            <th>ID marke</th>
                            <th>Naziv marke</th>
                        </tr>
                    </thead>
                    <tbody id='stavke'>

                    </tbody>
                </table>
            </div>
            <div class='col-5'>
                <h2>Dodaj marku</h2>
                <form class='mb-5' action="./server/marka/create.php" method="post"> 
                    <label>Naziv marke</label>
                    <input type="text" name='naziv' class='form-control'>
                    <label class='text-danger bg-light' <?php echo (!isset($_GET['greska']))?'hidden':''; ?> ><?php echo $_GET['greska']; ?></label>
                    <button type='submit' class='form-control btn btn-primary mt-2 dugme-pretraga'>Dodaj</button>
                </form>
            </div>
        </div>
    </div>

 

    <script src="https://code.jquery.com/jquery-3.6.0.js" 
   ></script>


    <script>
        $(document).ready(function () {
            $.getJSON('./server/marka/returnAll.php', function (data) {
                console.log(data);
                if (!data.status) {//false
                    alert(data.error);
                    return;
                }
                $('#stavke').html('');
                for (let marka of data.kolekcija) {
                    $('#stavke').append(`
                        <tr>
                            <td>${marka.id}</td>
                            <td>${marka.naziv}</td>
                            <td>
                                <button class='form-control btn btn-danger dugme-pretraga' onClick=obrisi(${marka.id}) >Obrisi</button>
                            </td>
                        </tr>
                    `)
                }
            })
        })


        function obrisi(marka_id) {
  $.ajax({
        url: './server/marka/delete.php',
        method: 'post',
        data: { id: marka_id },

        success: function (data) {
            window.location.reload();
        }
    })

}
/*
function obrisi(marka_id) {
            $.post('./server/marka/delete.php', { id: marka_id }, function (data) {
                if (data.status=='false') {
                    alert(data.error)
                } else {
                    window.location.reload();
                }
            })
        }*/


       
    </script>

</body>
</html>