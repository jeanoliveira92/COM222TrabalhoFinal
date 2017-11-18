<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        
        // Verifica primeiro se existem os campos e depois se estão vazios
        if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])){
            include_once("../mysqlconfig.php");
            
            // Recupera o email
            $email = addslashes(trim($_POST["email"]));
            // Recupera a senha, a criptografando em SHA256, a mais moderna atualmente
            $senha = hash('sha256', addslashes($_POST["senha"]));   
            // Conecta com o BD
            $dao = banco();
            // Constroi a query e executa
            $dao->buscar("usuario");
            $dao->where(array("email='".$email."'", "senha='".$senha."'"));
            $dado = $dao->executar();
            // Pega o dado
            $row = $dado->fetch_assoc();
  
            // Verifica se retornou algo e valida. Se entrar, o usuario existe
            if($row){            
                //Inicia sessões 
                
                // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
                $_SESSION["id"] = $row["id"]; 
                $_SESSION["nome"] = explode("",$row["nome"]);
                
                // VERIFICA SE O BOTAO LEMBRAR TA ATIVO
                echo $dao->sql."<br>";
            
                if(isset($_POST['remember'])){
                    echo "DENTRO";
                    $tempo_expiracao= time()+3600*24*5; // = 1h
                    setcookie("email", $email, $tempo_expiracao);
                    setcookie("senha", $senha, $tempo_expiracao);
                }
                // Redireciona para a index apos login
                header("location: ../index.php");
                echo $_SESSION['nome'];
            }else{
                // Usuario e/ou senha errados ou não existe
                header("location: logon.php?error=2");
            }
        }else{
            // Usuario e/ou senha em brancos ou invalidos
                header("location: logon.php?error=1");
        }
    }else{
       
    include_once("header.php"); ?>
                <form method="POST" action="logon.php">
                    <input type="text" placeholder="e-mail" name="email"><br>
                    <input type="password" placeholder="senha" name="senha" ><br>
                    <div class="form-check">
                        <label>
                          <input type="checkbox" name="remember" class="form-check-input">
                          Lembrar
                        </label>
                     </div>
                    <input type="button" value="Registrar" onclick="location.href = 'registrar.php'"> <input type="submit" value="Login  ">
                </form>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo "E-mail ou senha inválido(os)"; ?></div>
                <?php } ?> 
            </div>            
        </div>
    </div>
</div>
<?php 
    include_once("footer.php"); 
    }?>