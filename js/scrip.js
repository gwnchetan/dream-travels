window.addEventListener('scroll', function() {
    var navbar = document.getElementById('nav');
    if (window.scrollY > 0) {
        navbar.classList.add('nav-scrolled');
    } else {
        navbar.classList.remove('nav-scrolled');
    }
});




let oneWay = document.querySelector('#Routrip');
let Roundtrip = document.querySelector('#Routrip');
let btn1 = document.querySelector('.btn1'); 
let btn2 = document.querySelector('.btn2'); 



function one_Way(){
    oneWay.style.display = 'none';
    btn1.style.color = "#8d2ccd"
    btn2.style.color = "black"
   
    
}

function roun_trip(){
    oneWay.style.display = 'block'
    btn2.style.color = "#8d2ccd"
    btn1.style.color = "black"
  
}

