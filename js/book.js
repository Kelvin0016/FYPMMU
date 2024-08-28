function dateupdate()
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(((yyyy % 4 == 0) && (yyyy % 100 != 0)) || (yyyy % 400 == 0))
    {
        var feb=29;
    }
    else{
        var feb=28;
    }
    if(mm==2)
    {
        if(dd>(feb-14))
        {
            var cd = 14-(feb-dd);
            mm +=1;
            dd = 0+cd;
        }
        else
        {
            dd +=14;
        }
    }
    else if(mm==4||mm==6||mm==9||mm==11)
    {
        if(dd>(30-14))
        {
            var cd = 14-(30-dd);
            mm +=1;
            dd = 0+cd;
        }
        else
        {
            dd +=14;
        }
    }
    else
    {
        if(dd>(31-14))
        {
            var cd = 14-(31-dd);
            mm +=1;
            dd = 0+cd;
        }
        else
        {
            dd +=14;
        }
    }
    today = yyyy + '-' + String(mm).padStart(2, '0') + '-' + String(dd).padStart(2, '0');
    document.getElementById("event_date").setAttribute("min",today);
    yyyy+=1;
    today = yyyy + '-' + String(mm).padStart(2, '0') + '-' + String(dd).padStart(2, '0');
    document.getElementById("event_date").setAttribute("max",today);
}