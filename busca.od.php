<?php
include_once('conexao.php');

$registrosPorPagina = 20;
$paginaAtual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

$searchValue = isset($_POST['search']) ? $_POST['search'] : '';


// Calcula o offset com base na página atual e no número de registros por página
$offset = max(0, ($paginaAtual - 1) * $registrosPorPagina);

// Consulta SQL com paginação e busca
$query = "SELECT * FROM registro_psts WHERE nome LIKE '%$searchValue%' LIMIT $offset, $registrosPorPagina";


$result = $conexao->query($query);
if (!$result) {
    die('Erro na consulta SQL: ' . $conexao->error);
}
// Exibição dos resultados
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row['data_bkp'])) . "</td>";
        echo "<td>" . intval($row['hd']) . "</td>";
        echo "<td> 
        <a class='btn btn-sm btn-primary' href='#' onclick='editarRegistro(" . $row['id'] . ")'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
        </svg>
        </a>
        </td>"; // Substitua por suas ações de edição/exclusão
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="5">Registro não encontrado.</td></tr>';
}

// Cálculo do total de páginas
$sqlTotalRegistros = "SELECT COUNT(*) AS total FROM registro_psts WHERE nome LIKE '%$searchValue%'";
$resultTotalRegistros = $conexao->query($sqlTotalRegistros);
$totalRegistros = $resultTotalRegistros->fetch_assoc()["total"];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Links da paginação
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "<a href='javascript:handleClick($i, \"" . urlencode($searchValue) . "\")'>$i - </a>";
}


// Fechar conexão com o banco de dados
$conexao->close();
?>
