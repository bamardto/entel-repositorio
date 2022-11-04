export function formatBytes(bytes, precision=2){
    const a = ["B","KB","MB","GB", "TB"];
    bytes=Math.max(0, bytes); //para evitar números negativos
    let pow = Math.floor(bytes? Math.log(bytes) / Math.log(1024) : 0);

    pow = Math.min(pow, a.length -1);
    bytes /= Math.pow(1024, pow);
    return Math.round(bytes, precision) + " " + a[pow];

}