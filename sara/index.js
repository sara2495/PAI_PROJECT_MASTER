var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {
    myIndex = 1
  }
  x[myIndex - 1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}

function sendContactForm() {
  var form = document.getElementById("contactForm");
  console.log(form.value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("contactFormMessage").innerHTML = "Formularz został wysłany";
    }
  };
  xhttp.open("POST", "/sara/pages/sendMessage.php", true);
  xhttp.send(JSON.stringify({
    firstName: document.getElementsByName("firstName")[0].value,
    lastName: document.getElementsByName("lastName")[0].value,
    place: document.getElementsByName("place")[0].value,
    content: document.getElementsByName("content")[0].value
  }));

}