
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"> <!-- import FontAwesome -->

    <title>RMS Backups</title>
    
    
    <script src="./scripts/searchdata.js"></script>
    <link href="styles/home.css" rel="stylesheet"> <!-- Incluir seu arquivo CSS -->
</head>

<body>
    <div>
        <header>
            <div class="container-top">
                
                <h1>Biblioteca de Informações de Backups</h1>
                <img src="./images/Logotipo_RMS.png" alt="Logotipo RMS" class="ghostWhite">
            </div>
        </header>

        <main>
            <div class="container-form">
                <div>
                    <input type="search" name="nome" id="nome" placeholder="Pesquisar">
                    <button name="pesquisar" onclick="searchData()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <button id="mostrar-modal-botao"><i class="fa-solid fa-plus"></i></button>
                </div>
                <br>
                <div class="modal" id="modal">
                    <form id="form" method="POST" action="">
                        <label for="nomeModal">Nome:</label>
                        <input type="text" id="nomeModal" name="nome" required><br><br>
                        <label for="data">Data:</label>
                        <input type="date" id="data" name="data_bkp" required><br><br>
                        <label for="hd">HD:</label>
                        <input type="text" id="hd" name="hd" required><br><br>
                        <input type="submit" name="submit" id="submit">
<!--                        <button type="submit" name="submit" id="submit">Inserir</button> -->
                    </form>
                    <button id="closeModal">Fechar Modal</button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>DATA</th>
                            <th>HD</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="corpoTabela">
                        
                    </tbody>
                    
                </table>
                
            </div> 
            <br>
            <hr> 
            <br>
                                                                                                                                                                                                   
            <div class="pagination">
                   
                <!-- <ul class="pagination">
                 
                  <li><a href="#" onclick="previous">Previous</a></li>                                                                                                                                                                                                
                  <li><a href="#" onclck="pagina(1)">1</a></li>
                  <li><a href="#" onclck="pagina(2)">2</a></li>
                  <li><a href="#" onclck="pagina(3)">3</a></li>
                  <li><a href="#" onclck="pagina(4)">4</a></li>
                  <li><a href="#" onclck="pagina(5)">5</a></li>
                  <li><a href="#" onclck="pagina(6)">6</a></li>
                  <li><a href="#" onclck="pagina(7)">7</a></li> 
                  <li><a href="#">...</a></li>
                  <li><a href="#" onclck="next">Next</a></li>
                  <li><a href="#" onclck="Last">Last</a></li>

                </ul> -->
               
                <span id="previous" onclick="paginaAnterior()">Previous</span>
                <span id="pagina" onclick="pagina(1)">1</span>
                <span id="pagina" onclick="pagina(2)">2</span>
                <span id="pagina" onclick="pagina(3)">3</span>
                <span id="pagina" onclick="pagina(4)">4</span>
                <span id="pagina" onclick="pagina(5)">5</span>
                <span id="pagina" onclick="pagina(6)">6</span>
                <span id="pagina" onclick="pagina(7)">7</span>
                <span id="pagina" onclick="pagina(8)">8</span>
                <span id="pagina" onclick="pagina(9)">9</span>
                <span id="pagina" onclick="pagina(10)">10</span>
                <span id="next" onclick="proximaPagina()">Next</span>
                <span id="last" onclick="pagina(<?= $totalPaginas ?>)">Last &raquo;</span>  
            </div>
            <label for="registrosPorPagina">Mostrar:</label>
                <select id="registrosPorPagina" name="registrosPorPagina" onchange="searchData()">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

                <label for="registrosPorPagina">Mostrar:</label>
                <select id="registrosPorPagina" name="registrosPorPagina" onchange="searchData()">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                 
        </main>
        
    </div>
    <script src="./scripts/home.js"></script>
    
</body>


</html>

<?php

include_once('conexao.php');

    if(isset($_POST['submit']))
    {
        // include_once('conexao.php');

        $nome = $_POST['nome'];
        $data = $_POST['data_bkp'];
        $hd = $_POST['hd'];
    
        $result = mysqli_query($conexao, "INSERT INTO registro_psts(nome, data_bkp, hd, data_hora_registro) VALUES ('$nome','$data','$hd',NOW())");
        //$query = "INSERT INTO registro_psts (nome,data_bkp,hd) VALUES ('$nome','$data','$hd')";
        //$result = mysqli_query($conexao, $query);

        //if ($result) {
        //echo "Dados inseridos com sucesso!";
        //} else {
        //echo "Erro ao inserir dados: " . mysqli_error($conexao);
        //}

    }

?>

<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;


// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

$total_pages_sql = "SELECT COUNT(*) FROM  registro_psts";
$result = mysqli_query($conexao,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM registro_psts LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conexao,$sql);
while($row = mysqli_fetch_array($res_data)){
    //here goes the data
}
mysqli_close($conexao);
?>
<ul class="pagination">
<li><a href="?pageno=1">First</a></li>
<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
</li>
<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
