<?php
  require "config.php";
?>

<?php
 
 $select = $conn->query("select * from urls");
 $select->execute();
 $rows = $select->fetchALL(PDO::FETCH_OBJ);

 if(isset($_POST['submit'])){
    if($_POST['url']== ''){
        echo "the input is empty";
    }
    else{
        $url = $_POST['url'];
        $insert = $conn->prepare("Insert into urls (url) values (:url)");
        $insert->execute([
            ':url' => $url
        ]);
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {overflow: hidden;}
            
            .margin {
                margin-top: 100px
            }
        </style>
    </head>
    <body>
        <div class="container">
        <h2 class="text-center mt-7">LIST of URLS</h2>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form class="card p-2 margin" method="POST" action="index.php">
                        <div class="input-group">
                        <input type="text" name="url" class="form-control" placeholder="your url">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-dark">Shorten</button>
                        </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>

        <div class="container" id="refresh">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                            <th scope="col">Long URL</th>
                            <th scope="col">Short URl</th>
                            <th scope="col">Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $r) : ?>
                            <tr>
                            <th scope="row"><?php echo $r->url; ?></th>
                            <td><a href="http://localhost/Projects/shortURLs/u?id=<?php echo $r->id; ?>" target="_blank">http://localhost/Projects/shortURLs/u?id=<?php echo $r->id; ?></a></td>
                            <td><?php echo $r->clicks; ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                 </div>
             </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
        <script>
            $(document).ready(function() {
                $("#refresh").click(function(){
                     setInterval(function() {
                        $("body").load('index.php')
                     }, 5000);
                });
            });
        </script>
    </body>
</html>


   