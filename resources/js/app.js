import './bootstrap';


function _a(){
    const div=document.querySelectorAll('.toggle-menu');
    div.forEach(element => {
        var t=false;
        element.addEventListener('click',()=>{
            if(t===false){
                element.classList.add('active');
                t=true
            }else{
                element.classList.remove('active');
                t=false;
            }
        })
    });    
}
_a();