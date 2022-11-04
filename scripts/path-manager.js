import {requestHangleCurrentPath, 
        requestSetCurrentPathWithIndex, 
        requestHandleFolderAndFiles} from "./http.js";

export default class PathManager{
    async hangleCurrentPath(path=""){

        const formData = new FormData();
        formData.append("action", "get_current_path");
        formData.append("path", path);

        await requestHangleCurrentPath("path-manager/index.php", formData).
            then(json=>{
                let res = json["path"];
                $(".title").html(res);
                this.handleFolderAndFiles(json["current_path"]);
            }).
            catch(e=>alert(e))
    }

    async setCurrentPathWithIndex(index){
        const formData = new FormData();
        formData.append("action", "set_current_path_with_index");
        formData.append("index", index);
        await requestSetCurrentPathWithIndex("path-manager/index.php", formData).
            then(_ =>{
                this.hangleCurrentPath()
            }).
            catch(e=>alert(e))        
    }
    
    async handleFolderAndFiles(path){    
        const formData = new FormData();
        formData.append("action", "set_current_path");
        formData.append("path", path);
        await requestHandleFolderAndFiles("path-manager/index.php", formData)
            .then(res=>{
                document.querySelector(".content").innerHTML = res;
            }).
            catch(e => alert(e))
       
    }
}