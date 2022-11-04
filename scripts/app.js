import renderStorage from './storage-manager.js';
import PathManager from './path-manager.js';
import {requestLogout} from './http.js';

export default class App{
    constructor(){
        renderStorage();
        this.pathManager = new PathManager();
        this.pathManager.hangleCurrentPath();
        this.handleEvents();
    }

    handleEvents(){
        $(document).on('click', ".btn_sidebar", (e)=>{
            let data = e.target.getAttribute("data-pos");
            console.log(data);
            const contenedorPrincipal = document.getElementById('main-content-tool');
            const contenedorPrincipalUser = document.getElementById('main-content-tool-user');
            if(data === '3'){
                contenedorPrincipal.style.display = "none";
                contenedorPrincipalUser.style.display = "block";
            }else{
                contenedorPrincipal.style.display = "block";
                contenedorPrincipalUser.style.display = "none";
            }
            this.pathManager.setCurrentPathWithIndex(data);
        });
        
        $(document).on('click', ".folder", (e)=>{
            let data = e.target.closest(".folder").getAttribute("data-path");
            this.pathManager.hangleCurrentPath(data);
        })
        $(document).on('click', ".logout", (e)=>{
            this.logout();
        })
    }
    async logout(){
        const formData = new FormData();
        formData.append('action', 'logout')
        await requestLogout("./auth/index.php", formData).
            then(e=> e==="success"? location.reload() : alert(e)).
            catch(e=>alert(e))
        }
}