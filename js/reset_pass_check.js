function pass_focus()
{
    var pass,lblcon_pass;
    pass = document.getElementById("pass");
    lblcon_pass = document.getElementById("label_con_pass");
    if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
        lblcon_pass.style.marginTop="10px";
        pass.style.marginBottom="5px";
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
        pass.style.marginBottom="25px";
        document.getElementById("error_Pass").innerHTML="";
        Validation_Pass();
    }
}
function pass_blur()
{
    document.getElementById("passbox").style.display="none";
    document.getElementById("pass").style.marginBottom="0px";
    document.getElementById("label_con_pass").style.marginTop="0px";
    document.getElementById("error_Pass").innerHTML="";
}
function pass_keyup()
{
    var pass
    pass = document.getElementById("pass");
    if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
        pass.style.marginBottom="5px";
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
        pass.style.marginBottom="25px";
        document.getElementById("error_Pass").innerHTML="";
        Validation_Pass();
    }
}
function Validation_Pass()
{
    var pass = document.getElementById("pass");
    var lblcon_pass = document.getElementById("label_con_pass");
    document.getElementById("passbox").style.display="block";
    pass.style.marginBottom="5px";
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
      lower.style.color="green";
      check_lower = 1;
    } else {
      lower.style.color="red";
      check_lower = 0;
    }
    
    var upperCaseLetters = /[A-Z]/g;
    if(pass.value.match(upperCaseLetters)) {  
      upper.style.color="green";
      check_upper = 1;
    } else {
      upper.style.color="red";
      check_upper = 0;
    }
  
    var numbers = /[0-9]/g;
    if(pass.value.match(numbers)) {  
      number.style.color="green";
      check_number = 1;
    } else {
      number.style.color="red";
      check_number = 0;
    }

    var symbols = /[!@#$%^&*_]/g;
    if(pass.value.match(symbols)) {  
      symbol.style.color="green";
      check_symbol = 1;
    } else {
      symbol.style.color="red";
      check_symbol = 0;
    }

    if(pass.value.length >= 15) {
      length.style.color="green";
      check_length = 1;
    } else {
      length.style.color="red";
      check_length = 0;
    }

    if(check_length ==1 && check_lower ==1 && check_symbol ==1 && check_upper ==1 && check_number ==1)
    {
        document.getElementById("error_Pass").style.color="green";
        lblcon_pass.style.marginTop="10px";
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
    var con_pass
    con_pass = document.getElementById("con_pass");
    var sbmbtn = document.getElementById("sbmbtn");
    if(con_pass.value=="")
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        sbmbtn.style.marginTop="10px";
        con_pass.style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Retype Again Your Password";
        document.getElementById("error_ConPass").style.color="red";
        
    }
    else
    {
        document.getElementById("conpassbox").style.display="none";
        con_pass.style.marginBottom="25px";
        document.getElementById("error_ConPass").innerHTML="";
        Validation_Conpass();
    }
}
function con_pass_blur()
{
    document.getElementById("conpassbox").style.display="none";
    document.getElementById("con_pass").style.marginBottom="0px";
    document.getElementById("sbmbtn").style.marginTop="0px";
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
        con_pass.style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Retype Again Your Password";
        document.getElementById("error_ConPass").style.color="red";
    }
    else
    {
        document.getElementById("conpassbox").style.display="none";
        con_pass.style.marginBottom="25px";
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
        con_pass.style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Make Sure Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="red";
        return false;
    }
    else
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        con_pass.style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="green";
        document.getElementById("sbmbtn").style.marginTop="10px";
        return true;
    }
}

function check()
{
    var pass,con_pass;
    var pass_check=0,con_pass_check=0;
    pass = document.getElementById("pass");
    con_pass = document.getElementById("con_pass");
    if(pass.value=="")
    {
        document.getElementById("passbox").style.display="block";
        document.getElementById("label_con_pass").style.marginTop="10px";
        pass.style.marginBottom="5px";
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
        con_pass.style.marginBottom="5px";
        document.getElementById("error_ConPass").innerHTML="Please Make Sure Your Password Is Same As Above";
        document.getElementById("error_ConPass").style.color="red";
    }
    else if(con_pass.value=="")
    {
        document.getElementById("conpassbox").style.display="block";
        document.getElementById("conpassbox").style.marginBottom="10px";
        con_pass.style.marginBottom="5px";
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
    if(pass_check==1 && con_pass_check==1)
    {
        document.getElementById("submit").click();
    }
}