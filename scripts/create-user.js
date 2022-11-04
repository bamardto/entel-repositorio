getUsers();

document.forms['formAddUser'].onsubmit = (e) => {
    console.log("clicked");
    e.preventDefault();

    const xml = new XMLHttpRequest();

    xml.onreadystatechange = () => {
        if(xml.readyState == XMLHttpRequest.DONE){
            console.log("entro xml");
            if(xml.responseText == "success"){
                location.reload();
            }else{
                alert(xml.responseText);
            }
        }
    }
    const formData = new FormData(document.forms['formAddUser']);
    formData.append("action","register");
    xml.open("POST", "user-crud/index.php", true);
    xml.send(formData);
}

function getUsers(){
    const xml = new XMLHttpRequest();

    xml.onreadystatechange = () => {
        if(xml.readyState == XMLHttpRequest.DONE){
            console.log("entro xml");
            if(xml.status == 200){
                document.querySelector(".content-user").innerHTML = xml.response;
            }else{
                alert(xml.response);
            }
        }
    }

    xml.open("GET", "./user-crud/index.php", true);
    xml.send();
}

