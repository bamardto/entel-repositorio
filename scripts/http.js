export function requestRenderStore(link, formData=null, method = 'POST'){
    return new Promise((resolve, reject) => {
        requestJson(link, formData)
            .then(v=>resolve({"total":v["total"], "current":v["current"]}))
            .catch(e=>reject(e))
    })
}

export function requestHangleCurrentPath(link, formData=null, method = 'POST'){
    return new Promise((resolve, reject) => {
        requestJson(link, formData)
            .then(v=>resolve(v))
            .catch(e=>reject(e))
    })
}

export function requestSetCurrentPathWithIndex(link, formData=null, method = 'POST'){
    return new Promise((resolve, reject) => {
        requestText(link, formData)
            .then(v=>resolve(v))
            .catch(e=>reject(e))
    })
}
export function requestLogout(link, formData=null, method = 'POST'){
    return new Promise((resolve, reject) => {
        requestText(link, formData)
            .then(v=>resolve(v))
            .catch(e=>reject(e))
    })
}
export function requestHandleFolderAndFiles(link, formData=null, method = 'POST'){
    return new Promise((resolve, reject) => {
        requestText(link, formData)
            .then(v=>resolve(v))
            .catch(e=>reject(e))
    })
}

function requestText(link, formData=null, method = 'POST'){

    return new Promise((resolve, reject) => {
        const xml = new XMLHttpRequest();
    
        xml.onreadystatechange = () => {
            if(xml.readyState == xml.DONE){
                if(xml.status == 200){
                    resolve(xml.response)
                }else{
                    reject(xml.response);
                }
            }
        } 
        xml.open(method, link, true);
        xml.send(formData);
    })
}
function requestJson(link, formData=null, method = 'POST'){

    return new Promise((resolve, reject) => {
        const xml = new XMLHttpRequest();
    
        xml.onreadystatechange = () => {
            if(xml.readyState == xml.DONE){
                if(xml.status == 200){
                    try {
                        const json = JSON.parse(xml.response);
                        resolve(json)
                    } catch (e) {
                        reject(xml.response)
                    }
                }else{
                    reject(xml.response);
                }
            }
        } 
        xml.open(method, link, true);
        xml.send(formData);
    })
}