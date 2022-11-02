getStorage();

function getStorage(){
    const xml = new XMLHttpRequest();
    
    xml.onreadystatechange = () => {
        if(xml.readyState == xml.DONE){
            if(xml.status == 200){
                const json= JSON.parse(xml.response);
                const current = json["current"];
                const total = json["total"];
                let percentage = Math.round((current / total) * 100, 0);
                if(percentage > 100){
                    percentage = 100;
                }
                const str = `Has usado ${format(current,0)} de ${format(total)}`
                document.querySelector(".progress-container p").innerHTML = str;
                const proBar = document.querySelector(".progress .progress-bar");
                proBar.style.width = `${percentage}%`;
            }else{
                alert(xml.response);
            }
        }
    } 

    xml.open("POST", "./storage-manager/index.php", true);

    const formData = new FormData();
    formData.append("action","get_storage");
    xml.send(formData);


}

function format(bytes, precision=2){
    const a = ["B","KB","MB","GB", "TB"];
    bytes=Math.max(0, bytes); //para evitar números negativos
    let pow = Math.floor(bytes? Math.log(bytes) / Math.log(1024) : 0);

    pow = Math.min(pow, a.length -1);
    bytes /= Math.pow(1024, pow);
    return Math.round(bytes, precision) + " " + a[pow];

}