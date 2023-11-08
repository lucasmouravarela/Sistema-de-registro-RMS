function searchData() {
    var searchValue = document.getElementById('nome').value;
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('corpoTabela').innerHTML = xmlhttp.responseText;
        }
    };
    
    xmlhttp.open('POST', 'busca.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send('search=' + searchValue);
}

document.getElementById('submit').addEventListener('click', function (e) {
    e.preventDefault();
    searchData();
});