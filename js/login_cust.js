function chk_Pass() {
    var x = document.getElementById("pass");
    var y = document.getElementById("eye_pass");
    if (x.type === "password") {
        x.type = "text";
    } 
    else {
        x.type = "password";
    }
    if(y.className==="zmdi zmdi-eye"){
        y.className="zmdi zmdi-eye-off"
    }
    else{
        y.className="zmdi zmdi-eye"
    }
}
