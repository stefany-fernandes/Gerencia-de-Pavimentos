<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Starter Template - Materialize</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>
<?php
foreach ($this->session->getFlashBag()->all() as $type => $messages) {
    foreach ($messages as $message) {
        echo '<div class="row">
      <div class="col s12 m5">
        <div class="card-panel teal">
          <span class="white-text">'.$message.'</div></span>
        </div>
      </div>
    </div>';
    }
}?>
<body>
<form method="POST" enctype="multipart/form-data" action="salvarfoto">
    Defeito:<input name="Defeito" type="text" />
    Selecione uma imagem: <input name="arq" type="file" />
   <br />
   <input type="submit" value="Salvar" />
</form>
</body>