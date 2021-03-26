<?php
        require '../model/produits.php'; 
        session_start();             
        $sporttb=isset($_SESSION['sporttbl0'])?unserialize($_SESSION['sporttbl0']):new produits();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creation de produit</title>
    <link rel="stylesheet" href="~/../../../public/css/bootstrap.css"> 
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Ajout de produit</h2>
                    </div>
                    <form action="./produit.php?act=add" method="post" >
                        <div class="form-group <?php echo (!empty($sporttb->qtStock_msg)) ? 'has-error' : ''; ?>">
                            <label>Stock du produit</label>
                            <input type="number" name="qtStock" class="form-control" value="<?php echo $sporttb->qtStock; ?>">
                            <span class="help-block"><?php echo $sporttb->qtStock_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->ref_msg)) ? 'has-error' : ''; ?>">
                            <label>Referrence du produit</label>
                            <input type="text" name="ref" class="form-control" value="<?php echo $sporttb->ref; ?>">
                            <span class="help-block"><?php echo $sporttb->ref_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Nom du produit</label>
                            <input name="nom" class="form-control" value="<?php echo $sporttb->nom; ?>">
                            <span class="help-block"><?php echo $sporttb->name_msg;?></span>
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Ajouter">
                        <a href="./produit.php" class="btn btn-default">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>