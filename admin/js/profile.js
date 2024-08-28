$(document).ready(function(){
	$('.profile-body .nav.nav-tabs li a').on('click', function(){
		$('.profile-body .nav.nav-tabs li a').removeClass('active');
	});
});

function chkCur_Pass() {
    var x = document.getElementById("cur_pass");
    var y = document.getElementById("eye_cur_pass");
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

function chkCon_Pass() {
    var x = document.getElementById("con_pass");
    var y = document.getElementById("eye_con_pass");
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

function name_focus()
{
    var name
    name = document.getElementById("nm");
    if(name.value=="")
    {
    document.getElementById("namebox").style.display="block";
    document.getElementById("user-name").style.marginBottom="5px";
    document.getElementById("error_N").style.color="red";
    document.getElementById("error_N").innerHTML="Please Fill In Your Name";
    }
    else
    {
        document.getElementById("namebox").style.display="none";
        document.getElementById("user-name").style.marginBottom="35px";
        document.getElementById("error_N").innerHTML="";
        Validation_Name();
    }
}
function name_blur()
{
	document.getElementById("namebox").style.display="none";
	document.getElementById("user-name").style.marginBottom="35px";
    document.getElementById("error_N").innerHTML="";
}
function name_keyup()
{
    var name
    name = document.getElementById("nm");
    if(name.value=="")
    {
        document.getElementById("namebox").style.display="block";
        document.getElementById("user-name").style.marginBottom="5px";
        document.getElementById("error_N").style.color="red";
        document.getElementById("error_N").innerHTML="Please Fill In Your Name";
    }
    else
    {
        document.getElementById("namebox").style.display="none";
        document.getElementById("user-name").style.marginBottom="35px";
        document.getElementById("error_N").innerHTML="";
        Validation_Name();
    }
}
function Validation_Name()
{
    var mailformat = /^([A-Za-z ]*)$/;
    var email = document.getElementById("nm");
    if (mailformat.test(email.value)==false)
    {
        document.getElementById("namebox").style.display="block";
        document.getElementById("user-name").style.marginBottom="5px";
        document.getElementById("error_N").style.color="red";
        document.getElementById("error_N").innerHTML="You Have Entered an Invalid Name";
        return false;
    }
    else
    {
        document.getElementById("namebox").style.display="block";
        document.getElementById("user-name").style.marginBottom="5px";
        document.getElementById("error_N").style.color="green";
        document.getElementById("error_N").innerHTML="You type a correct Name";
        return true;
    }

}

function email_focus()
{
    var email
    email = document.getElementById("email");
    if(email.value=="")
    {
        document.getElementById("emailbox").style.display="block";
        document.getElementById("user-email").style.marginBottom="5px";
        document.getElementById("error_Email").innerHTML="Please Fill In Your Email";
        document.getElementById("error_Email").style.color="red";
    }
    else
    {
        document.getElementById("emailbox").style.display="none";
		document.getElementById("user-email").style.marginBottom="35px";
        document.getElementById("error_Email").innerHTML="";
        Validation_Email();
    }
}
function email_blur()
{
    document.getElementById("emailbox").style.display="none";
    document.getElementById("user-email").style.marginBottom="35px";
    document.getElementById("error_Email").innerHTML="";
}
function email_keyup()
{
    var email
    email = document.getElementById("email");
    if(email.value=="")
    {
        document.getElementById("emailbox").style.display="block";
        document.getElementById("user-email").style.marginBottom="5px";
        document.getElementById("error_Email").innerHTML="Please Fill In Your Email";
        document.getElementById("error_Email").style.color="red";
    }
    else
    {
        document.getElementById("emailbox").style.display="none";
        document.getElementById("user-email").style.marginBottom="35px";
        document.getElementById("error_Email").innerHTML="";
        Validation_Email();
    }
}
function Validation_Email()
{
    var mailformat = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var email = document.getElementById("email");
    if (mailformat.test(email.value)==false)
    {
        document.getElementById("emailbox").style.display="block";
        document.getElementById("user-email").style.marginBottom="5px";
        document.getElementById("error_Email").style.color="red";
        document.getElementById("error_Email").innerHTML="You Have Entered an Invalid Email Address";
        return false;
    }
    else
    {
        document.getElementById("emailbox").style.display="block";
        document.getElementById("user-email").style.marginBottom="5px";
        document.getElementById("error_Email").style.color="green";
        document.getElementById("error_Email").innerHTML="You Email Can be Used";
        return true;
    }

}

function phone_focus()
{
    var phone
    phone = document.getElementById("phone");
    if(phone.value=="")
    {
        document.getElementById("phonebox").style.display="block";
        document.getElementById("user-phone").style.marginBottom="5px";
        document.getElementById("error_Phone").innerHTML="Please Fill In Your Phone Number";
        document.getElementById("error_Phone").style.color="red";
    }
    else
    {
        document.getElementById("phonebox").style.display="none";
        document.getElementById("user-phone").style.marginBottom="35px";
        document.getElementById("error_Phone").innerHTML="";
        Validation_Phone();
    }
}
function phone_blur()
{
    document.getElementById("phonebox").style.display="none";
    document.getElementById("user-phone").style.marginBottom="35px";
    document.getElementById("error_Phone").innerHTML="";
}
function phone_keyup()
{
    var phone
    phone = document.getElementById("phone");
    if(phone.value=="")
    {
        document.getElementById("phonebox").style.display="block";
        document.getElementById("user-phone").style.marginBottom="5px";
        document.getElementById("error_Phone").innerHTML="Please Fill In Your Phone Number";
        document.getElementById("error_Phone").style.color="red";
    }
    else
    {
        document.getElementById("phonebox").style.display="none";
        document.getElementById("user-phone").style.marginBottom="35px";
        document.getElementById("error_Phone").innerHTML="";
        Validation_Phone();
    }
}
function Validation_Phone()
{
    var phoneformat = /^[0][1][0-9]-[0-9]{7,8}$/;
    var phone = document.getElementById("phone");
    if (phoneformat.test(phone.value)==false)
    {
        document.getElementById("phonebox").style.display="block";
        document.getElementById("user-phone").style.marginBottom="5px";
        document.getElementById("error_Phone").innerHTML="You Have Entered an Invalid Phone Number (01x-xxxxxxxx)";
        document.getElementById("error_Phone").style.color="red";
        return false;
    }
    else
    {
        document.getElementById("phonebox").style.display="block";
        document.getElementById("user-phone").style.marginBottom="5px";
        document.getElementById("error_Phone").innerHTML="Your Phone Number Can Be Used";
        document.getElementById("error_Phone").style.color="green";
        return true;
    }
}

function cur_pass_focus()
{
    var cur_pass
    cur_pass = document.getElementById("cur_pass");
    if(cur_pass.value=="")
    {
        document.getElementById("curpassbox").style.display="block";
        document.getElementById("curpassbox").style.marginBottom="10px";
        document.getElementById("current-password").style.marginBottom="5px";
        document.getElementById("error_CurPass").innerHTML="Please Type Your Current Password";
        document.getElementById("error_CurPass").style.color="red";
        
    }
    else
    {
        document.getElementById("curpassbox").style.display="none";
        document.getElementById("current-password").style.marginBottom="35px";
        document.getElementById("error_CurPass").innerHTML="";
    }
}
function cur_pass_blur()
{
    document.getElementById("curpassbox").style.display="none";
    document.getElementById("current-password").style.marginBottom="35px";
    document.getElementById("error_CurPass").innerHTML="";
}
function cur_pass_keyup()
{
    var cur_pass;
    cur_pass = document.getElementById("cur_pass");
    if(cur_pass.value=="")
    {
        document.getElementById("curpassbox").style.display="block";
        document.getElementById("curpassbox").style.marginBottom="10px";
        document.getElementById("current-password").style.marginBottom="5px";
        document.getElementById("error_CurPass").innerHTML="Please Type Your Current Password";
        document.getElementById("error_CurPass").style.color="red";
    }
    else
    {
        document.getElementById("curpassbox").style.display="none";
        document.getElementById("current-password").style.marginBottom="35px";
        document.getElementById("error_CurPass").innerHTML="";
    }
}

function pass_focus()
{
    var pass
    pass = document.getElementById("pass");
    if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
		document.getElementById("new-password").style.marginBottom="5px";
        document.getElementById("error_Pass").style.color="red";
        document.getElementById("error_Pass").innerHTML="Please Fill In Your Password";
        document.getElementById("uppercase").innerHTML="";
        document.getElementById("lowercase").innerHTML="";
        document.getElementById("number").innerHTML="";
        document.getElementById("symbol").innerHTML="";
        document.getElementById("length").innerHTML="";
    }
    else
    {
        document.getElementById("passbox").style.display="none";
        document.getElementById("new-password").style.marginBottom="35px";
        document.getElementById("error_Pass").innerHTML="";
        Validation_Pass();
    }
}
function pass_blur()
{
    document.getElementById("passbox").style.display="none";
	document.getElementById("new-password").style.marginBottom="35px";
    document.getElementById("error_Pass").innerHTML="";
}
function pass_keyup()
{
    var pass
    pass = document.getElementById("pass");
    if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
        document.getElementById("new-password").style.marginBottom="5px";
        document.getElementById("error_Pass").style.color="red";
        document.getElementById("error_Pass").innerHTML="Please Fill In Your Password";
        document.getElementById("uppercase").innerHTML="";
        document.getElementById("lowercase").innerHTML="";
        document.getElementById("number").innerHTML="";
        document.getElementById("symbol").innerHTML="";
        document.getElementById("length").innerHTML="";
    }
    else
    {
        document.getElementById("passbox").style.display="none";
        document.getElementById("new-password").style.marginBottom="35px";
        document.getElementById("error_Pass").innerHTML="";
        Validation_Pass();
    }
}
function Validation_Pass()
{
    var pass = document.getElementById("pass");
    document.getElementById("passbox").style.display="block";
	document.getElementById("new-password").style.marginBottom="5px";
    document.getElementById("error_Pass").style.color="black";
    document.getElementById("error_Pass").innerHTML="Your password must contain the following:";
    document.getElementById("uppercase").innerHTML="<br>1. A <b>Uppercase</b> Letter";
    document.getElementById("lowercase").innerHTML="<br>2. A <b>Lowercase</b> Letter";
    document.getElementById("number").innerHTML="<br>3. A <b>number</b>";
    document.getElementById("symbol").innerHTML="<br>4. A <b>symbol</b>";
    document.getElementById("length").innerHTML="<br>5. Minimum <b>15 characters</b>";
    var lower = document.getElementById("lowercase");
    var upper = document.getElementById("uppercase");
    var number = document.getElementById("number");
    var symbol = document.getElementById("symbol");
    var length = document.getElementById("length");
    var check_lower = 0, check_upper = 0, check_number = 0, check_symbol = 0, check_length = 0;

    var lowerCaseLetters = /[a-z]/g;
    if(pass.value.match(lowerCaseLetters)) {  
      lower.classList.remove("invalid");
      lower.classList.add("valid");
      check_lower = 1;
    } else {
      lower.classList.remove("valid");
      lower.classList.add("invalid");
      check_lower = 0;
    }
    
    var upperCaseLetters = /[A-Z]/g;
    if(pass.value.match(upperCaseLetters)) {  
      upper.classList.remove("invalid");
      upper.classList.add("valid");
      check_upper = 1;
    } else {
      upper.classList.remove("valid");
      upper.classList.add("invalid");
      check_upper = 0;
    }
  
    var numbers = /[0-9]/g;
    if(pass.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
      check_number = 1;
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
      check_number = 0;
    }

    var symbols = /[!@#$%^&*_]/g;
    if(pass.value.match(symbols)) {  
      symbol.classList.remove("invalid");
      symbol.classList.add("valid");
      check_symbol = 1;
    } else {
      symbol.classList.remove("valid");
      symbol.classList.add("invalid");
      check_symbol = 0;
    }

    if(pass.value.length >= 15) {
      length.classList.remove("invalid");
      length.classList.add("valid");
      check_length = 1;
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
      check_length = 0;
    }

    if(check_length ==1 && check_lower ==1 && check_symbol ==1 && check_upper ==1 && check_number ==1)
    {
        document.getElementById("error_Pass").style.color="green";
        document.getElementById("error_Pass").innerHTML="Your password can be used";
        document.getElementById("uppercase").innerHTML="";
        document.getElementById("lowercase").innerHTML="";
        document.getElementById("number").innerHTML="";
        document.getElementById("symbol").innerHTML="";
        document.getElementById("length").innerHTML="";
        return true;
    }
    else
    {
        return false;
    }
}

function con_pass_focus()
{
    var con_pass;
    con_pass = document.getElementById("con_pass");
    if(con_pass.value=="")
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Retype Again Your Password";
        document.getElementById("error_ConPass").style.color="red";
        
    }
    else
    {
        document.getElementById("conpassbox").style.display="none";
        document.getElementById("confirm-password").style.marginBottom="35px";
        document.getElementById("error_ConPass").innerHTML="";
        Validation_Conpass();
    }
}
function con_pass_blur()
{
    document.getElementById("conpassbox").style.display="none";
    document.getElementById("confirm-password").style.marginBottom="35px";
    document.getElementById("error_ConPass").innerHTML="";
}
function con_pass_keyup()
{
    var con_pass
    con_pass = document.getElementById("con_pass");
    if(con_pass.value=="")
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Retype Again Your Password";
        document.getElementById("error_ConPass").style.color="red";
    }
    else
    {
        document.getElementById("conpassbox").style.display="none";
        document.getElementById("confirm-password").style.marginBottom="35px";
        document.getElementById("error_ConPass").innerHTML="";
        Validation_Conpass();
    }
}
function Validation_Conpass()
{
    var con_pass,pass;
    pass = document.getElementById("pass");
    con_pass = document.getElementById("con_pass");
    if(con_pass.value!=pass.value)
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Make Sure Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="red";
        return false;
    }
    else
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="green";
        return true;
    }
}

function check()
{
    var name,email,phone;
    var name_check =0, email_check = 0, phone_check=0;
    name = document.getElementById("nm");
    email = document.getElementById("email");
    phone = document.getElementById("phone");
    if(name.value=="")
    {
		document.getElementById("namebox").style.display="block";
        document.getElementById("user-name").style.marginBottom="5px";
        document.getElementById("error_N").style.color="red";
		document.getElementById("error_N").innerHTML="Please Fill In Your Name";
    }
    else
    {
        if(Validation_Name())
        {
        name_check=1;
        }
    }
    if(email.value=="")
    {
        document.getElementById("user-email").style.marginBottom="5px";
        document.getElementById("emailbox").style.display="block";
        document.getElementById("error_Email").innerHTML="Please Fill In Your Email";
    }
    else
    {
        if(Validation_Email())
        {
        email_check=1;
        }
    }
    if(phone.value=="")
    {
        document.getElementById("user-phone").style.marginBottom="5px";
        document.getElementById("phonebox").style.display="block";
        document.getElementById("error_Phone").innerHTML="Please Fill In Your Phone Nummber";
    }
    else
    {
        if(Validation_Phone())
        {
        phone_check=1;
        }
    }
    if(name_check==1 && email_check==1 &&phone_check==1)
    {
		document.edit_profile.submit();
    }
}

function PassSub()
{
	var pass,con_pass, cur_pass;
    var pass_check=0,con_pass_check=0, cur_pass_check=0;
    pass = document.getElementById("pass");
	con_pass = document.getElementById("con_pass");
	cur_pass = document.getElementById("cur_pass");
    if(cur_pass.value=="")
    {
        document.getElementById("curpassbox").style.display="block";
        document.getElementById("curpassbox").style.marginBottom="10px";
        document.getElementById("current-password").style.marginBottom="5px";
        document.getElementById("error_CurPass").innerHTML="Please Type Your Current Password";
        document.getElementById("error_CurPass").style.color="red";
    }
    else
    {
        document.getElementById("curpassbox").style.display="none";
        document.getElementById("current-password").style.marginBottom="35px";
		document.getElementById("error_CurPass").innerHTML="";
		cur_pass_check =1;
    }
	if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
        document.getElementById("new-password").style.marginBottom="5px";
        document.getElementById("error_Pass").style.color="red";
        document.getElementById("error_Pass").innerHTML="Please Fill In Your Password";
        document.getElementById("uppercase").innerHTML="";
        document.getElementById("lowercase").innerHTML="";
        document.getElementById("number").innerHTML="";
        document.getElementById("symbol").innerHTML="";
        document.getElementById("length").innerHTML="";
    }
    else
    {
        if(Validation_Pass())
        {
            pass_check=1;
        }
    }
    if(con_pass.value!=pass.value)
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Make Sure Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="red";
    }
    else if(con_pass.value=="")
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        document.getElementById("confirm-password").style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Retype Again Your Password";
        document.getElementById("error_ConPass").style.color="red";
    }
    else
    {
        if(Validation_Conpass())
        {
            con_pass_check=1;
        }
	}
	if(pass_check==1 && con_pass_check==1 && cur_pass_check ==1)
    {
		document.edit_pass.submit();
    }
}
