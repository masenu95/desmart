const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

var d = 0;
var txts = 'Enter your personal details and start journey with us.';
var speeds = 100;

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});


signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});




function typeWriters() {
   if (d < txts.length) {
    document.getElementById("reg-text").innerHTML += txts.charAt(d);
    d++;
    setTimeout(typeWriters, speeds);
  }
}


var i = 0;
var txt = 'To keep connected with us please login with your personal info.';
var speed = 100;

 window.onload = function typeWriter() {
    if (i < txt.length) {
      document.getElementById("log-text").innerHTML += txt.charAt(i);
      i++;
      setTimeout(typeWriter, speed);
    }
  }

/*  hide and show navigation */

new WOW().init();
