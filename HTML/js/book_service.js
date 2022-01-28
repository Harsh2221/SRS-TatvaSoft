
const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')


tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)
    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active')
      
    })
    tabs.forEach(tab => {
      // tab.classList.remove('active')
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
function cancle_form(){
  if(address==1)
  {
    document.getElementById("address_form").style.display="inline";
    return address=0;
  }else{
    document.getElementById("address_form").style.display="none";
    return address=1;
  }
}