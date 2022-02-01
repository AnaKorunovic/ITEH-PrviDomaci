<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kafeterija</title>
</head>

<body>


<?php include 'header.php'; ?>

<style>
    body {
     
       background-image: url('../img/first.jpg');
       background-size: cover;
    }
</style>

<div class="container">
        <div class=" row mt-2 poz">
            <div class="col-3 ">
                <select id='sort' class="form-control">
                    <option value="">Sortiraj po nazivu</option>
                    <option value="ASC">po abecedi</option>
                    <option value="DESC">unazad</option>
                </select>
            </div>
           
            <div class="col-3">
                <select id='marka' class="form-control">
                    <option value="0">Filtriraj po marki</option>

                </select>
            </div>
            <div class="col-6">
                <input type="text" id='nazivFil' class="form-control " placeholder="Filtriraj po nazivu">
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
            $('#nazivFil').change(function () {
                ispisi();
            })

        })
        function ispisi() {
            const marka = $('#marka').val();
            const sort = $('#sort').val();
            const imeFilter = $('#nazivFil').val();
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
                            <img src='${kafa.slika}' width='100%' height='300' />
                            <h4 class='text-center'>${kafa.naziv}</h4>
                            <h5 class='text-center'>${kafa.marka_id}</h5>  
                            
                           <a href='./promena.php?id=${kafa.id}'> <button class='form-control btn-success mb-2 dugme-pretraga'>Vidi</button></a>
                        </div>
                    `
                ) 
            }
        }

    </script>
    

 
</body>

</html>