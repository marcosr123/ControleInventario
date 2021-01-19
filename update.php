<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $marcaErro = null;
    $modeloErro = null;
    $tomboErro = null;
    $qntErro = null;
    $unidadeErro = null;
    $setorErro = null;

    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tombo = $_POST['tombo'];
    $unidade = $_POST['unidade'];
    $setor = $_POST['setor'];
    $qnt = $_POST['qnt'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($tombo)) {
        $tomboErro = 'Por favor digite o tombo!';
        $validacao = false;
    }

    if (empty($marca)) {
        $marcaErro = 'Por favor digite a marca!';
        $validacao = false;
    }

    if (empty($modelo)) {
        $modeloErro = 'Por favor digite o modelo!';
        $validacao = false;
    }

    if (empty($unidade)) {
        $unidadeErro = 'Por favor preencha o campo!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE estoque  set nome = ?, marca = ?, modelo = ?, tombo = ?, qnt = ?, unidade = ?, setor = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $marca, $modelo, $tombo, $qnt, $unidade, $setor, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM estoque where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $marca = $data['marca'];
    $modelo = $data['modelo'];
    $tombo = $data['tombo'];
    $qnt = $data['qnt'];
    $unidade = $data['unidade'];
    $setor = $data['setor'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Item</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Item </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($marcaErro) ? 'error' : ''; ?>">
                        <label class="control-label">Marca</label>
                        <div class="controls">
                            <input name="marca" class="form-control" size="80" type="text" placeholder="Marca"
                                   value="<?php echo !empty($marca) ? $marca : ''; ?>">
                            <?php if (!empty($marcaErro)): ?>
                                <span class="text-danger"><?php echo $marcaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($modeloErro) ? 'error' : ''; ?>">
                        <label class="control-label">Modelo</label>
                        <div class="controls">
                            <input name="modelo" class="form-control" size="30" type="text" placeholder="modelo"
                                   value="<?php echo !empty($modelo) ? $modelo : ''; ?>">
                            <?php if (!empty($modeloErro)): ?>
                                <span class="text-danger"><?php echo $modeloErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($tomboErro) ? 'error' : ''; ?>">
                        <label class="control-label">Tombo</label>
                        <div class="controls">
                            <input name="tombo" class="form-control" size="40" type="text" placeholder="tombo"
                                   value="<?php echo !empty($tombo) ? $tombo : ''; ?>">
                            <?php if (!empty($tomboErro)): ?>
                                <span class="text-danger"><?php echo $tomboErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($unidadeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Unidade</label>
                        <div class="controls">
                            <input name="unidade" class="form-control" size="40" type="text" placeholder="Unidade"
                                   value="<?php echo !empty($unidade) ? $unidade : ''; ?>">
                            <?php if (!empty($unidadeErro)): ?>
                                <span class="text-danger"><?php echo $unidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($setorErro) ? 'error' : ''; ?>">
                        <label class="control-label">Setor</label>
                        <div class="controls">
                            <input name="setor" class="form-control" size="40" type="text" placeholder="Setor"
                                   value="<?php echo !empty($setor) ? $setor : ''; ?>">
                            <?php if (!empty($setorErro)): ?>
                                <span class="text-danger"><?php echo $setorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($qntErro) ? 'error' : ''; ?>">
                        <label class="control-label">Quantidade</label>
                        <div class="controls">
                            <input name="qnt" class="form-control" size="40" type="number" min="0" placeholder="Quantidade"
                                   value="<?php echo !empty($qnt) ? $qnt : ''; ?>">
                            <?php if (!empty($qntErro)): ?>
                                <span class="text-danger"><?php echo $qntErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
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
