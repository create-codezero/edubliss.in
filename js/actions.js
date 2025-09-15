function clickOn(elementId) {
     $(`#${elementId}`).toggleClass("none");
}


function showHidePassword(element) {
     let elementId = document.getElementById(`${element.id}`).getAttribute("id");
     $(`#${element.id}`).toggleClass("fa-eye");
     $(`#${element.id}`).toggleClass("fa-eye-slash");
     console.log(elementId);

     if (elementId == "signInEye") {
          // get password input type
          let password = document.getElementById("password");
          let passwordType = password.getAttribute('type');

          if (passwordType == "Password") {
               password.setAttribute("type", "Text");
          } else if (passwordType == "Text") {
               password.setAttribute("type", "Password");
          } else {
               console.log("Error ! '1'");
          }
     } else if (elementId == "re-signInEye") {
          // get password input type
          let password = document.getElementById("re-password");
          let passwordType = password.getAttribute('type');

          if (passwordType == "Password") {
               password.setAttribute("type", "Text");
          } else if (passwordType == "Text") {
               password.setAttribute("type", "Password");
          } else {
               console.log("Error ! '2'");
          }
     } else {
          console.log("Error ! '3'");
     }
}




