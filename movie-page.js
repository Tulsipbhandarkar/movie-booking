
const container = document.querySelector(".container");
const seats = document.querySelectorAll(".seat:not(.occupied)");
const count = document.getElementById("count");
const total = document.getElementById("total");

var $seat = $('#s_table');

console.log($seat);
const movieSelect =0;
var ticketPrice = 0;

 
// $(document).ready(function(){
  // $('.seat').click(function() {

  var selected_seats = new Array();
  s_counter=0;
   $seat.delegate('.seat','click',function() {
    if (!$(this).hasClass('occupied') && !$(this).hasClass('seat selected') ){
      $(this).removeClass('seat');
      $(this).addClass('seat selected');
      ss=$(this).text();
      selected_seats.push(ss);
      seat_price=$(this).parent().attr("class");
   
      s_counter+=1;

      ticketPrice+=parseInt(seat_price);
      console.log("Seat selected " +ss +" Price:"+seat_price + "Total:" +ticketPrice);
      count.innerHTML = s_counter;
      total.innerHTML = ticketPrice;
      // updateSelectedCount();
    }
    else if($(this).hasClass('seat selected')){
      $(this).removeClass('seat selected');
      $(this).addClass('seat');
      ss=$(this).text();
      selected_seats.splice(ss,1);
      seat_price=$(this).parent().attr("class");

      s_counter-=1;

      ticketPrice-=parseInt(seat_price);
      console.log("Seat deselected " +ss+" Price:"+seat_price + "Total:" +ticketPrice);
      count.innerHTML = s_counter;
      total.innerHTML = ticketPrice;
      // updateSelectedCount();
    }
     
    if(count.innerHTML>0){
   $('#submit-book').prop('disabled',false);
    }
    else{
   $('#submit-book').prop('disabled',true);
    }
});





// movieSelect.addEventListener("change", (e) => {
//   ticketPrice = parseInt(e.target.value);
//   updateSelectedCount();
// });

// container.addEventListener("click", (e) => {
//   console.log(e);
//   if (
//     e.target.classList.contains("seat") &&
//     !e.target.classList.contains("occupied")
//   ) {
//     e.target.classList.toggle("selected");
//     updateSelectedCount();
//   }
// })