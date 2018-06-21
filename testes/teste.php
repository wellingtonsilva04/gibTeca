<html lang="pt-br">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <title>CADASTRO DE Usuário</title>
  <style type="text/css">
    <!--
    .style1 {
      color: #FF0000;
      font-size: x-small;
      }
      .style3 {color: #0000FF; font-size: x-small; }
  </style>
  <script type="text/javascript">
      function validaCampo()
      {
      if(document.cadastro.nome.value=="")
      {
      alert("O Campo nome é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.email.value=="")
      {
      alert("O Campo email é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.endereco.value=="")
      {
      alert("O Campo endereço é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.cidade.value=="")
      {
      alert("O Campo Cidade é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.estado.value=="")
      {
      alert("O Campo Estado é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.bairro.value=="")
      {
      alert("O Campo Bairro é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.pais.value=="")
      {
      alert("O Campo país é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.login.value=="")
      {
      alert("O Campo Login é obrigatório!");
      return false;
      }
      else
      if(document.cadastro.senha.value=="")
      {
      alert("Digite uma senha!");
      return false;
      }
      else
      return true;
      }
      <!-- Fim do JavaScript que validará os campos obrigatórios! -->
  </script>
</head>
 
<body>
<!--navbar INICIO-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
    <li class="nav-item">
      <form class="form-inline" action="/action_page.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </li>
  </ul>

  

</nav>
<!--navbar FIM-->
<form id="cadastro" name="cadastro" method="post" action="cadastro.php" onsubmit="return validaCampo(); return false;">
  <table width="625" border="0">
    <tr>
      <td width="69">Nome:</td>
      <td width="546"><input name="nome" type="text" id="nome" size="70" maxlength="60" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input name="email" type="text" id="email" size="70" maxlength="60" />
      <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Sexo:</td>
      <td><input name="sexo" type="radio" value="Masculino" checked="checked" />
        Masculino
        <input name="sexo" type="radio" value="Feminino" />
        Feminino <span class="style1">*</span> </td>
    </tr>
    <tr>
      <td>DDD:</td>
      <td><input name="ddd" type="text" id="ddd" size="4" maxlength="2" />
      Telefone:
        <input name="telefone" type="text" id="telefone" />
        <span class="style3">Apenas números</span> </td>
    </tr>
    <tr>
      <td>Endereço:</td>
      <td><input name="endereco" type="text" id="endereco" size="70" maxlength="70" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td><input name="cidade" type="text" id="cidade" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td><select name="estado" id="estado">
        <option>Selecione...</option>
        <option value="AC">AC</option>
        <option value="AL">AL</option>
        <option value="AP">AP</option>
        <option value="AM">AM</option>
        <option value="BA">BA</option>
        <option value="CE">CE</option>
        <option value="ES">ES</option>
        <option value="DF">DF</option>
        <option value="MA">MA</option>
        <option value="MT">MT</option>
        <option value="MS">MS</option>
        <option value="MG">MG</option>
        <option value="PA">PA</option>
        <option value="PB">PB</option>
        <option value="PR">PR</option>
        <option value="PE">PE</option>
        <option value="PI">PI</option>
        <option value="RJ">RJ</option>
        <option value="RN">RN</option>
        <option value="RS">RS</option>
        <option value="RO">RO</option>
        <option value="RR">RR</option>
        <option value="SC">SC</option>
        <option value="SP">SP</option>
        <option value="SE">SE</option>
        <option value="TO">TO</option>
          </select>
        <span class="style1">*      </span></td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><input name="bairro" type="text" id="bairro" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>País:</td>
      <td><input name="pais" type="text" id="pais" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Login:</td>
      <td><input name="login" type="text" id="login" maxlength="12" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Senha:</td>
      <td><input name="senha" type="password" id="senha" maxlength="12" />
          <span class="style1">*</span></td>
    </tr>
    <tr>
      <td colspan="2"><input name="news" type="checkbox" id="news" value="ATIVO" checked="checked" />
Desejo receber novidades e informações sobre o conteúdo deste site. </td>
    </tr>
    <tr>
      <td colspan="2"><p>
        <input name="cadastrar" type="submit" id="cadastrar" value="Concluir meu Cadastro!" />
       
 
          <input name="limpar" type="reset" id="limpar" value="Limpar Campos preenchidos!" />
         
 
          <span class="style1">* Campos com * são obrigatórios!          </span></p>
      <p>  </p></td>
    </tr>
  </table>
</form>
</body>
</html>