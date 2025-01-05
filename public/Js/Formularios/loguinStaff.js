window.onload = ()=>{
    let $$ = (ele)=>{return document.querySelectorAll(ele)}    
    let $ = (ele)=>{return document.querySelector(ele)}    
    let rcImg = 0
    let images = $$('.imgpromotionStaff')
    imageRecord(images)
    function imageRecord(images) {
        if (rcImg > 0 && rcImg < images.length) {
            images[rcImg-1].style.display = 'none'
        }
        images[rcImg].style.display = 'block'
        setTimeout(() => {
            imageShow(images)
        }, 2500);
    }
    function imageShow(images) {
        console.log(images.length)
        console.log(rcImg)
        if(rcImg < images.length){
            rcImg++
            imageRecord(images,rcImg)
        }
    }
}