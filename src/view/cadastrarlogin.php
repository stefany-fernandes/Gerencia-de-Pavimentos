<!doctype html>
<html lang="pt_BR">
<body>
<form action="cadastrologin" method="post">

  <div class="container">
      <label><b>Nome</b></label>
      <input type="text" placeholder="Digite seu nome" name="nome" required>


      <label><b>Usuário</b></label>
    <input type="text" placeholder="usuario" name="login" required>

    <label><b>Senha</b></label>
    <input type="password" placeholder="senha" name="senha" required>

      <label><b>Repita sua senha</b></label>
      <input type="password" placeholder="senha" name="senha" required>

    <button type="submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me
</div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
</form>
</body>
</html>