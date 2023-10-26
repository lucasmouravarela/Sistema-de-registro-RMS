<?php
include_once('conexao.php');

if (isset($_GET['search'])) {
    $searchValue = $_GET['search'];
    
    // Obtenha a quantidade de registros por página do parâmetro
    $registrosPorPagina = isset($_GET['registrosPorPagina']) ? intval($_GET['registrosPorPagina']) : 10; // Valor padrão 10 se não definido.
    
    // Obtenha a página atual
    $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
    
    // Calcule o deslocamento (offset) com base na página atual
    $offset = ($paginaAtual - 1) * $registrosPorPagina;

    // Realize a consulta adaptada ao seu banco de dados com LIMIT e OFFSET
    $query = "SELECT *  FROM registro_psts WHERE nome LIKE '%$searchValue' LIMIT $registrosPorPagina OFFSET $offset";

    // $query2 = "SELECT COUNT(id) as total   FROM registro_psts";
    // $result2 = mysqli_query($conexao, $query2);
    // $row2 = mysqli_fetch_assoc($result2);
    // echo $row2['total'];

    // Execute a consulta


    $result = mysqli_query($conexao, $query);


    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['data_bkp'] . "</td>";
            echo "<td>" . $row['hd'] . "</td>";
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
        echo "<tr><td colspan='5'>Nenhum resultado encontrado.</td></tr>";
    }
}


?>
