<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Regular</title>
    <style {csp-style-nonce}>
        html {
  height: 100%;
}

.hero {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(221, 72, 20, .8);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
  a{
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #03e9f4;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 40px;
    letter-spacing: 4px;
  }
}

</style>
</head>
<body>
    <div class="hero">
        <h2>Bienvenido(a) <?php echo $nombre; ?></h2>
        <a href="/public/logout">Cerrar Session</a>
    </div>
</body>
</html>