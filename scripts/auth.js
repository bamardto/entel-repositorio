document.forms[0].onsubmit = (e) => {
    e.preventDefault();

    const xml = new XMLHttpRequest();

    xml.onreadystatechange = () => {
        if(xml.readyState == XMLHttpRequest.DONE){
            if(xml.responseText == "success"){
                location.reload();
            }else{
                alert(xml.responseText);
            }
        }
    }
    const formData = new FormData(document.forms[0]);
    formData.append("action","login");
    xml.open("POST", "../auth/index.php", true);
    xml.send(formData);
}

