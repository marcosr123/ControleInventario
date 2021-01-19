

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $marcaErro = null;
    $modeloErro = null;
    $tomboErro = null;
    $qntErro = null;
    $unidadeErro = null;
    $setorErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o nome!';
            $validacao = False;
        }


        if (!empty($_POST['marca'])) {
            $marca = $_POST['marca'];
        } else {
            $marcaErro = 'Por favor digite a Marca!';
            $validacao = False;
        }


        if (!empty($_POST['modelo'])) {
            $modelo = $_POST['modelo'];
        } else {
            $modeloErro = 'Por favor digite o modelo!';
            $validacao = False;
        }


        if (!empty($_POST['tombo'])) {
            $tombo = $_POST['tombo'];
        } else {
            $tomboErro = 'Por favor digite um Marca de tombo!';
            $validacao = False;
        }


        if (!empty($_POST['qnt'])) {
            $qnt = $_POST['qnt'];
        } else {
            $qntErro = 'Por favor insira a quantidade!';
            $validacao = False;
        }

        if (!empty($_POST['unidade'])) {
            $unidade = $_POST['unidade'];
        } else {
            $unidadeErro = 'Por favor insira a unidade!';
            $validacao = False;
        }

        if (!empty($_POST['setor'])) {
            $setor = $_POST['setor'];
        } else {
            $setorErro = 'Por favor insira o setor!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO estoque (nome, marca, modelo, tombo, qnt, unidade, setor) VALUES(?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $marca, $modelo, $tombo, $qnt, $unidade, $setor));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Item</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Item </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome do Equipamento"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($marcaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Marca</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="marca" type="text" placeholder="EX: Lenovo"
                                   value="<?php echo !empty($marca) ? $marca : ''; ?>">
                            <?php if (!empty($tomboErro)): ?>
                                <span class="text-danger"><?php echo $marcaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($modeloErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Modelo</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="modelo" type="text" placeholder="EX: S145"
                                   value="<?php echo !empty($modelo) ? $modelo : ''; ?>">
                            <?php if (!empty($modeloErro)): ?>
                                <span class="text-danger"><?php echo $modeloErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($tomboErro) ? '$tomboErro ' : ''; ?>">
                        <label class="control-label">Tombo</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="tombo" type="text" placeholder="Tombo"
                                   value="<?php echo !empty($tombo) ? $tombo : ''; ?>">
                            <?php if (!empty($tomboErro)): ?>
                                <span class="text-danger"><?php echo $tomboErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($unidadeErro) ? '$unidadeErro ' : ''; ?>">
                        <label class="control-label">Unidade</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="unidade" type="text" placeholder="EX: SEAP"
                                   value="<?php echo !empty($unidade) ? $unidade : ''; ?>">
                            <?php if (!empty($unidadeErro)): ?>
                                <span class="text-danger"><?php echo $unidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($setorErro) ? '$setorErro ' : ''; ?>">
                        <label class="control-label">Setor</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="setor" type="text" placeholder="EX: SRT"
                                   value="<?php echo !empty($setor) ? $setor : ''; ?>">
                            <?php if (!empty($setorErro)): ?>
                                <span class="text-danger"><?php echo $setorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($qntErro) ? '$qntErro ' : ''; ?>">
                        <label class="control-label">Quantidade</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="qnt" type="number" min="0" placeholder="Quantidade"
                                   value="<?php echo !empty($qnt) ? $qnt : ''; ?>">
                            <?php if (!empty($qntErro)): ?>
                                <span class="text-danger"><?php echo $qntErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

