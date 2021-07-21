const container = document.querySelector(".container");
const seats = document.querySelectorAll(".row .seat:not(.occupied)");
const count = document.getElementById("count");
const total = document.getElementById("total");
const movieSelect = document.getElementById("movie");

// let ticketPrice = parseInt(movieSelect.value);
let ticketPrice = 10;

function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".row .selected");
  const selectedSeatsCount = selectedSeats.length;
  count.innerHTML = selectedSeatsCount;
  total.innerHTML = selectedSeatsCount * ticketPrice;
}

$(document).ready(function(){

  $('movieSelect').change(function() {
    console.log(pasreInt(this.value));
    updateSelectedCount();
  });

  $('.seat').click(function() {

    if (!$(this).hasClass('occupied') && !$(this).hasClass('seat selected') ){
      console.log("ROW RUNNING");
      $(this).removeClass('seat');
      $(this).addClass('seat selected');
      updateSelectedCount();
    }
    else if($(this).hasClass('seat selected')){
      $(this).removeClass('seat selected');
      $(this).addClass('seat');
      updateSelectedCount();
    }

});

})

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