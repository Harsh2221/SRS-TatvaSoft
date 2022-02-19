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
    $("#address_form").show();
    return address=0;
  }else{
    $("#address_form").hide();
    return address=1;
  }
}

function cancle_form(){
  
  $("#inputstreet").val("");
  $("#inputhouse").val("");
  $("#inputpostal").val("");
  $("#inputcity").val("");
  $("#inputphone").val("");
  
  $("#address_form").hide();
  return address=1;

}

function changeImage1() {
  document.getElementById("tab-2").classList.add("active");
  document.getElementById("img1").src="./assets/assets/schedule-white.png";
  
  
}
function changeImage2(){
  document.getElementById("img2").src="./assets/assets/details-white.png";
}
function changeImage3(){
  document.getElementById("img3").src="./assets/assets/payment-white.png";
}
 
$(document).ready(function(){

  //updating date into payment card------------------->

  $("#datepicker").on("change", function(){
    var select = $(this).val();
    // alert(select);
    document.querySelector('.selected_date').innerHTML = select;
    });

  //updating time into payment card-------------------->

  function select_time(){
    var select_times = parseFloat($('#select_time').val());
    var select_hours = parseFloat($('#select_hours').val());
  
    totaltime = select_times + select_hours
  // alert(totaltime);
  
    if (totaltime >= 21) {
        $('.time_error').text("Please Select less than 21 hour time");
    } else {
        $('.time_error').text("");
  
    }
   }

  $("#select_time").on("change", function(){
    time();
    // alert("time");
  });

  function time(){
    select_time();
    var time=$("#select_time option:selected").text();
    document.querySelector('.selected_time').innerHTML=time;

  }

  //updating hours into payment card------------------>

$("#select_hours").on("change", function(){
  
  hours();
  // alert("select hour");
});
function hours(){
  select_time();
  var total_hour = document.querySelector('.total_time').innerHTML;
  var total_hour_value = parseFloat(total_hour);
  var infoofhour = document.querySelector('#select_hours').selectedIndex;
  var selecthours = document.querySelector("#select_hours").options[infoofhour].innerHTML;
  var info_temp = parseFloat(selecthours);

  if ((info_temp < total_hour_value) && ($('.extr_1').css("display") == "block" || $('.extr_2').css("display") == "block" || $('.extr_3').css("display") == "block" || $('.extr_4').css("display") == "block" || $('.extr_5').css("display") == "block")) {
    document.querySelector('#select_hours').value = total_hour_value;
    alert('it not work');
    
}else {

  var data = $("#select_hours option:selected").text();
  document.querySelector('.total_time').innerHTML = data;
  document.querySelector('.basic_time').innerHTML = data;

}
}
 
//upadating extra service - 1 ---------------->

$(".ser-1") .click(function(){

  document.getElementById("s-1").classList.toggle("active");
  
  extr_ser1();

 });

var toggle1 = true;
function extr_ser1(){
  var info = $(".total_time").text();
  var info = parseFloat(info);
  var time = info;
  select_time();
  if(toggle1 == true)
  {
    document.getElementById('img-1').src='./assets/assets/3-green.png';
    $(".extr_1").css("display", "block");

    // alert("success");

  var select_hour = document.querySelector('#select_hours').selectedIndex + 1;
  document.querySelector('#select_hours').options.selectedIndex = select_hour;
  time = time + 0.5;
  document.querySelector('.total_time').innerHTML = time + ' Hrs';
    

  }else{
    document.getElementById('img-1').src='./assets/assets/3.png';
    $(".extr_1").css("display", "none");

    var select_hour = document.querySelector('#select_hours').selectedIndex - 1;
    document.querySelector('#select_hours').options.selectedIndex = select_hour;

    var total_time = $('.total_time').text();
    var total_time = parseFloat(total_time);
    total_time = total_time - 0.5;

    document.querySelector('.total_time').innerHTML = total_time + ' Hrs';

  }
  toggle1 = !toggle1;
}

//upadating extra service - 2 ---------------->

$(".ser-2") .click(function(){

  document.getElementById("s-2").classList.toggle("active");
  
  extr_ser2();

 });

var toggle2 = true;
function extr_ser2(){
  var info = $(".total_time").text();
  var info = parseFloat(info);
  var time = info;
  select_time();
  if(toggle2 == true)
  {
    document.getElementById('img-2').src='./assets/assets/5-green.png';
    $(".extr_2").css("display", "block");

    var select_hour = document.querySelector('#select_hours').selectedIndex + 1;
  document.querySelector('#select_hours').options.selectedIndex = select_hour;
  time = time + 0.5;
  document.querySelector('.total_time').innerHTML = time + ' Hrs';

  }else{
    document.getElementById('img-2').src='./assets/assets/5.png';
    $(".extr_2").css("display", "none");

    var select_hour = document.querySelector('#select_hours').selectedIndex - 1;
    document.querySelector('#select_hours').options.selectedIndex = select_hour;

    var total_time = $('.total_time').text();
    var total_time = parseFloat(total_time);
    total_time = total_time - 0.5;

    document.querySelector('.total_time').innerHTML = total_time + ' Hrs';
  }
  toggle2 = !toggle2;
}

//upadating extra service - 3 ---------------->

$(".ser-3") .click(function(){

  document.getElementById("s-3").classList.toggle("active");
  
  extr_ser3();

 });

var toggle3 = true;
function extr_ser3(){
  var info = $(".total_time").text();
  var info = parseFloat(info);
  var time = info;
  select_time();
  if(toggle3 == true)
  {
    document.getElementById('img-3').src='./assets/assets/4-green.png';
    $(".extr_3").css("display", "block");

    var select_hour = document.querySelector('#select_hours').selectedIndex + 1;
  document.querySelector('#select_hours').options.selectedIndex = select_hour;
  time = time + 0.5;
  document.querySelector('.total_time').innerHTML = time + ' Hrs';

  }else{
    document.getElementById('img-3').src='./assets/assets/4.png';
    $(".extr_3").css("display", "none");

    var select_hour = document.querySelector('#select_hours').selectedIndex - 1;
    document.querySelector('#select_hours').options.selectedIndex = select_hour;

    var total_time = $('.total_time').text();
    var total_time = parseFloat(total_time);
    total_time = total_time - 0.5;

    document.querySelector('.total_time').innerHTML = total_time + ' Hrs';
  }
  toggle3 = !toggle3;
}

//upadating extra service - 4 ---------------->

$(".ser-4") .click(function(){

  document.getElementById("s-4").classList.toggle("active");
  
  
  extr_ser4();

 });

var toggle4 = true;
function extr_ser4(){
  var info = $(".total_time").text();
  var info = parseFloat(info);
  var time = info;
  select_time();
  if(toggle4 == true)
  {
    document.getElementById('img-4').src='./assets/assets/2-green.png';
    $(".extr_4").css("display", "block");

    var select_hour = document.querySelector('#select_hours').selectedIndex + 1;
  document.querySelector('#select_hours').options.selectedIndex = select_hour;
  time = time + 0.5;
  document.querySelector('.total_time').innerHTML = time + ' Hrs';

  }else{
    document.getElementById('img-4').src='./assets/assets/2.png';
    $(".extr_4").css("display", "none");

    var select_hour = document.querySelector('#select_hours').selectedIndex - 1;
    document.querySelector('#select_hours').options.selectedIndex = select_hour;

    var total_time = $('.total_time').text();
    var total_time = parseFloat(total_time);
    total_time = total_time - 0.5;

    document.querySelector('.total_time').innerHTML = total_time + ' Hrs';
  }
  toggle4 = !toggle4;
}
  

//upadating extra service - 5 ---------------->

$(".ser-5") .click(function(){

  document.getElementById("s-5").classList.toggle("active");
  
  extr_ser5();

 });

var toggle5 = true;
function extr_ser5(){
  var info = $(".total_time").text();
  var info = parseFloat(info);
  var time = info;
  select_time();
  if(toggle5 == true)
  {
    document.getElementById('img-5').src='./assets/assets/1-green.png';
    $(".extr_5").css("display", "block");

    var select_hour = document.querySelector('#select_hours').selectedIndex + 1;
  document.querySelector('#select_hours').options.selectedIndex = select_hour;
  time = time + 0.5;
  document.querySelector('.total_time').innerHTML = time + ' Hrs';

  }else{
    document.getElementById('img-5').src='./assets/assets/1.png';
    $(".extr_5").css("display", "none");

    var select_hour = document.querySelector('#select_hours').selectedIndex - 1;
    document.querySelector('#select_hours').options.selectedIndex = select_hour;

    var total_time = $('.total_time').text();
    var total_time = parseFloat(total_time);
    total_time = total_time - 0.5;

    document.querySelector('.total_time').innerHTML = total_time + ' Hrs';
  }
  toggle5 = !toggle5;
}

//upadating total time------------------------------>

$('.total_time').on('DOMSubtreeModified', function(){
select_time();
// alert("test");
var txt = $(".total_time").text();
var info = parseFloat(txt);
var price = info * 18;
document.querySelector('#payment').innerHTML = '$' + price;
        
var effe_price = (20 * price) / 100;
var effective_price = price - effe_price;
document.querySelector('#effective_price').innerHTML = '$' + effective_price;

});




}); 

$(document).ready(function () {

  //Address form validation ---------------------->

  $("#save").on('click', function () {
    var street = $("#inputstreet").val();
    var house = $("#inputhouse").val();
    var phone = $("#inputphone").val();
    
    if(street.length==0){
      $('.street_error').text("please enter street name !");
    }
    else{
      $('.street_error').empty();
    }
    
    if(house.length==0){
      $('.house_error').text("please enter house number !");
    }else{
      $('.house_error').empty();
    }

    if(phone.length==0){
      $('.phone_error').text("please enter phone number !");
    }
    else{
      $('.phone_error').empty();
    }


});

 

  $('#card .cc-number').formatCardNumber();
  $('#card .cc-expires').formatCardExpiry();
  $('.cc-cvc').formatCardCVC();
  
}); 