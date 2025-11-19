<?php
require_once "conexao.php";

// =====================
// 1. CARREGAR CARROS ATIVOS
// =====================
$sql = "SELECT id, nome_carro, marca, ano_carro FROM carros WHERE ativo = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$carros = $result->fetch_all(MYSQLI_ASSOC);

// =====================
// 2. PROCESSAR DESATIVAÇÃO
// =====================
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['selecionar-carro-excluir'])) {
        $mensagem = "Nenhum carro selecionado!";
    } else {

        $id = $_POST['selecionar-carro-excluir'];

        // Desativar o carro — apenas isso
        $sql = "UPDATE carros SET ativo = 0 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $mensagem = "Carro desativado com sucesso!";
        } else {
            $mensagem = "Erro ao desativar o carro.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desativar Carro</title>
    <link rel="stylesheet" href="src/CSS/pages/excluir-carro.css">
</head>
<body>
    <header>
        <div id="logo-senna-header">
            <a href="index.html">
                <img src="../assets/images/logos/Ayrton_Senna_Branco_logo_horizontal.png" alt="">
            </a>
        </div>
    </header>
    <br>

    <div class="divFormularioDesativar">

        <?php if ($mensagem): ?>
            <p style="color: white; background: black; padding: 10px; border-radius: 5px;">
                <?= htmlspecialchars($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="" method="post">
            <h1>Desativar Carro</h1>
            <table border="1">
                <tr>
                    <td>Selecione o carro para desativar:</td>
                    <td>
                        <select name="selecionar-carro-excluir" required>
                            <option value="" disabled selected>Escolha um carro</option>

                            <?php foreach ($carros as $carro): ?>
                                <option value="<?= $carro['id'] ?>">
                                    <?= htmlspecialchars($carro['nome_carro']) ?> —
                                    <?= htmlspecialchars($carro['marca']) ?> —
                                    <?= htmlspecialchars($carro['ano_carro']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </td>
                </tr>
            </table>

            <br>

            <input type="checkbox" name="check-responsa" id="check-responsa" style="cursor: pointer;" required>
            <label for="check-responsa">Me responsabilizo que, após desativar o carro, não terá como reverter essa ação.</label>

            <br><br>

            <input type="submit" value="Desativar Carro" id="enviar-formulario">
        </form>
    </div>

</body>
</html>
