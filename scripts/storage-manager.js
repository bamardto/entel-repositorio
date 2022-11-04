import {formatBytes} from './utils.js';
import {requestRenderStore} from './http.js';

export default async function renderStorage(){

    const formData = new FormData();
    formData.append("action","get_storage");

    await requestRenderStore("./storage-manager/index.php", formData).
        then(json=>{
        const current = json["current"];
        const total = json["total"];
        let percentage = Math.round((current / total) * 100, 0);
        if(percentage > 100)percentage = 100;
        
        const str = `Has usado ${formatBytes(current,0)} de ${formatBytes(total)}`
        document.querySelector(".progress-container p").innerHTML = str ;
        const proBar = document.querySelector(".progress .progress-bar");
        proBar.style.width = `${percentage}%`;

    }).
    catch(e => alert(e))
}