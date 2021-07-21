var myIndex = 0;
carousel();
console.log("running");
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000); // Change image every 2 seconds
 
}


// $(document).ready(function changecity() {

//     $('.cityname').on('click', function cityclicked(){
//       var cname= $(this).text();
//       console.log( $(this).text());
//       $('#cityselected').html(cname);

//       $.ajax({
//         url: "index.php",
//         method: "POST",
//         data: { "selectedCity": cname }
//       })

//       var xmlhttp=new XMLHttpRequest();
//       xmlhttp.onreadystatechange=function() {
//         if(this.readyState==4 && this.status==200) {
//           // document.getElementById("txtHint").innerHTML=this.responseText;
//         }
//       }
//       xmlhttp.open("GET","index.php?q="+cname,true);
//       xmlhttp.send();

//     });
// });



// $(document).ready(function changemovie() {

//   $('.cityname').on('click', function cityclicked(){
//     var cname= $(this).text();
//     console.log( $(this).text());
//     $('#cityselected').html(cname);
//   });
// });