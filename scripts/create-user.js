getUsers();

document.forms['formAddUser'].onsubmit = (e) => {
    console.log("clicked");
    e.preventDefault();

    const xml = new XMLHttpRequest();

    xml.onreadystatechange = () => {
        if(xml.readyState == XMLHttpRequest.DONE){
            console.log("entro xml");
            if(xml.responseText == "success"){
                setTimeout(() => {
                    
                    
                }, 2000);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Usuario creado con exito!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getUsers();
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

function getRadioIdAndDelete() {
    $(document).on('click','input[type="radio"]:checked' ,function(e) { 
        const item = this.value;
        console.log(item);
        document.getElementById("confirmUser").addEventListener("click", function (){
            
            const dataString = 'item='+item;
        
            $.ajax({
                type: "POST",
                url: "user-crud/index.php",
                data: dataString,
                success: function(response) {	
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El usuario ha sido Eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    
                }

            });
            
        });
    });
}
getRadioIdAndDelete();

