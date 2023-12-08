<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Import Excel Data into database in PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
#progress-bar {
    background-color: #12CC1A;
    color: #FFFFFF;
    width: 0%;
    -webkit-transition: width .3s;
    -moz-transition: width .3s;
    transition: width .3s;
    border-radius: 5px;
}

#targetLayer {
    width: 100%;
    text-align: center;
}
</style>
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.form.min.js"> type="text/javascript"</script>
<script>
        $('form').on('submit', function(e){
            e.preventDefault();
            $('#loader-icon').show();
            $.ajax({
                type: "POST",
                url: "upload.php",
                data: new FormData(this),
                beforeSubmit: function() {
                  $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status" class="text-center">' + percentComplete +' %</div>')
                },
                contentType: false,
            processData: false,
            
                success: function(response){
                   
                    $('#loader-icon').hide();
               
                }
            });
        });
    </script>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            <div id="msg">
                <?php
                    if(isset($_SESSION['msg'])){?>
                        <p><?= $_SESSION['msg'] ?></p>
                   <?php } $_SESSION['msg'] = null;
                 ?>
            </div>
                <div class="card">
                    <div class="card-header">
                        <h4>How to Import Excel Data into database in PHP</h4>
                    </div>
                    <div class="card-body">

                        <form enctype="multipart/form-data" method="post" action="upload.php">

                            <input type="file" name="import_file" id="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                            <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Import</button>
                            <div class="row">
                                <div id="progress-bar"></div>
                            </div>
                            <div id="targetLayer"></div>
                        </form>
                        
                    </div>
                    
                <div id="loader-icon" style="display: none;">
                    <img src="LoaderIcon.gif" />
                </div>
                </div>
            </div>
        </div>
    </div>
   
   
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>