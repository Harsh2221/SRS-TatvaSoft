const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')


tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)
    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active')
      
    })
    
    tab.classList.add('active')
    target.classList.add('active')
  })
})

var address;
function show_form(){
  if(address==1)
  {
    document.getElementById("address_form").style.display="inline";
    return address=0;
  }else{
    document.getElementById("address_form").style.display="none";
    return address=1;
  }
}

function changeImage1() {
  document.getElementById("img1").src="assets/schedule-white.png";
  
}
function changeImage2(){
  document.getElementById("img2").src="assets/details-white.png";
}


function changeImage3(){
  document.getElementById("img3").src="assets/payment-white.png";
}



function toggleService_1() {

  document.getElementById("s-1").classList.toggle("active");
  
  document.getElementById("img-1").src="assets/3-green.png";
 }

 function toggleService_2() {

  document.getElementById("s-2").classList.toggle("active");
  document.getElementById("img-2").src="assets/5-green.png";
  
 }

 function toggleService_3() {

  document.getElementById("s-3").classList.toggle("active");
  document.getElementById("img-3").src="assets/4-green.png";
  
 }

 function toggleService_4() {

  document.getElementById("s-4").classList.toggle("active");
  document.getElementById("img-4").src="assets/2-green.png";
  
 }

 function toggleService_5() {

  document.getElementById("s-5").classList.toggle("active");
  document.getElementById("img-5").src="assets/1-green.png";
  
 }