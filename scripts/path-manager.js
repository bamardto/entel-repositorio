$(document).on('click', ".btn_sidebar", (e)=>{
    data = e.target.getAttribute("data-pos");
    console.log(data);
    setCurrentPathWithIndex(data);
});

$(document).on('click', ".folder", (e)=>{
    data = e.target.closest(".folder").getAttribute("data-path");
    console.log(data);
    hangleCurrentPath(data);
})



hangleCurrentPath()

function hangleCurrentPath(path=""){
    const xml = new XMLHttpRequest();
    
    xml.onreadystatechange = () => {
        if(xml.readyState == xml.DONE){
            if(xml.status == 200){
                const json = JSON.parse(xml.response)
                let res = json["path"];
                console.log(res);
                $(".title").html(res);
                handleFolderAndFiles(json["current_path"]);
            }else{
                alert(xml.response);
            }
        }
    }

    xml.open("POST", "path-manager/index.php", true);

    const formData = new FormData();
    formData.append("action", "get_current_path");
    formData.append("path", path);
    xml.send(formData);
}

function setCurrentPathWithIndex(index){
    const xml = new XMLHttpRequest();
    
    xml.onreadystatechange = () => {
        if(xml.readyState == xml.DONE){
            if(xml.status == 200){
                hangleCurrentPath();
            }else{
                alert(xml.response);
            }
        }
    }

    xml.open("POST", "path-manager/index.php", true);

    const formData = new FormData();
    formData.append("action", "set_current_path_with_index");
    formData.append("index", index);
    xml.send(formData);
}

function handleFolderAndFiles(path){
    const xml = new XMLHttpRequest();
    
    xml.onreadystatechange = () => {
        if(xml.readyState == xml.DONE){
            if(xml.status == 200){
                document.querySelector(".content").innerHTML = xml.response;
            }else{
                alert(xml.response);
            }
        }

    }
    xml.open("POST", "path-manager/index.php", true);

    const formData = new FormData();
    formData.append("action", "set_current_path");
    formData.append("path", path);
    xml.send(formData);
}