<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <h1>Authentification</h1>
<body>
    <?php if ($user == null) { ?>
        <form action="login" method="post">
            <p><label>Login<input type="text" name="login"></label></p>
            <p><label>Pass<input type="password" name="pass"></label></p>
            <button>S'authentifier</button>
        </form>
    <?php } else { ?>
        <p>Connecté <?= $user ?></p>
        <form action="logout">
            <button>se déconnecter</button>
        </form>
            
    <?php } ?>
</body>
</html>
