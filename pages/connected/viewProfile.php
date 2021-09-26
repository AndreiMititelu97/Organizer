<?php 
    $profile = getUserByEmail($_SESSION['user']);
?>
<h1>Your profile</h1>
<div class="item-container">
    <div class="card-body item-card text-center">
        <div class="card-img">
            <img class="card-img-top" src="img/<?php if(isset($profile['poza_profil'])){print $profile['poza_profil'];}else{print 'default_pic.png';} ?>" alt="Imaginea nu este disponibila momentan" wdith="180px" height="250px" >
        </div>
        <div class="card-text" style='color:white;'>
            <h5><b><?php print $profile['nume'].' '.$profile['prenume']; ?></b></h5>
            <h5><?php print $profile['email'];?></h5>
        </div>  
    </div>
    
    <form method="post"  enctype="multipart/form-data">
    <div class="mb-3">
        <h5>Add a profile pic</h5>
        <input type="file" class="form-control" id="image" name="image" style='background-color: #f1f1f1;'>
    </div>
     <button type="submit" class="btn btn-info" name="add">Confirm</button>
</form>
    
</div>
<?php
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

if(isset($_POST['add']) && isset($_FILES['image'])){
     //verific daca exista vreo eroare
    if($_FILES['image']['error'] == 0){// nu avem eroare
        //verificare tip fisier
        switch($_FILES['image']['type']){
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
            case 'image/bmp':
                $nameImage = uniqid() . $_FILES['image']['name'];//adaugare id unic+ numele fisierul cu terminatie fisier ->imaginea este unica, nu se suprascrie
                //salvare pe server -> mutare fisier din folderul temp
                $saveServer = move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $nameImage);
                
                if($saveServer){
                    $addPhoto = addPhoto($nameImage, $_SESSION['id_user']);
                    if($addPhoto){
                        print '<div style="color:green">Profile pic uploaded</div>';
                    }else{//pentru cazul in care nu s-a salvat in db, sterg img de pe server
                        unlink('img/' . $nameImage);
                        print '<div style="color:red">Could not add to database</div>';
                    }
                }else{
                    print '<div style="color:red">Could not add to database</div>';
                }
                break;
            default:
                print '<div style="color:red">File is not an image</div>';
                break; 
        }
    }  
}
?>


