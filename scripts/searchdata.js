function paginaAnterior() {
    var paginaAtual = /* Obtenha a página atual a partir do seu estado ou variável ----------> $paginaAtual */;
    if (paginaAtual > 1) {
        pagina(paginaAtual - 1);
    }
}

function proximaPagina() {
    var paginaAtual = /* Obtenha a página atual a partir do seu estado ou variável ---------> $paginaAtual */;
    var registrosPorPagina = document.getElementById('registrosPorPagina').value;
    var totalRegistros = /* Obtenha o total de registros com base na sua consulta */;
    var totalPaginas = Math.ceil(totalRegistros / registrosPorPagina);

    if (paginaAtual < totalPaginas) {
        pagina(paginaAtual + 1);
    }
}

// function searchData()
function pagina(numero) {
    var searchValue = document.getElementById('nome').value;
    var registrosPorPagina = document.getElementById('registrosPorPagina').value; // Obtenha a quantidade escolhida.
    
    // Atualize o URL da consulta para incluir o parâmetro de registros por página.
    var url = 'busca.php?search=' + searchValue + '&registrosPorPagina=' + registrosPorPagina;

    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('corpoTabela').innerHTML = xmlhttp.responseText;
        }
    };
    
    // xmlhttp.open('GET', 'busca.php?search=' + searchValue, true);
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function editarRegistro(id) {
    // Implemente a lógica de edição com base no ID recebido.
    $('#editModal').modal('show');
    alert('Editar registro com ID ' + id); // Exemplo simples
}

