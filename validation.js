function onlyalpha(id,msg){
    var data=id.value;
    var alpha=data.match(/[a-z|A-Z ]+/);
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if(data!=alpha){
        msg.innerHTML="Enter only alpha";
    }
    else{
        msg.innerHTML="";
    }
}
function checklength(id,msg,min,max)
{
    var data=id.value;
    var len=data.length;
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if((len<min) || (len>max))
    {
        msg.innerHTML="length between "+min +" to "+max;
    }
    else
    {
        msg.innerHTML=" ";
    }
}
function validateEmail(id, msg) {
    var data = id.value;
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if (!emailPattern.test(data)) {
        msg.innerHTML = "Enter a valid email address";
    } else {
        msg.innerHTML = "";
    }
}

function validateContactNo(id, msg) {
    var data = id.value;
    var contactPattern = /^[0-9]{10}$/; 
    if (data === "") {
        msg.innerHTML = ""; 
    }
    else if (!contactPattern.test(data)) {
        msg.innerHTML = "Enter a valid 10-digit contact number";
    } else {
        msg.innerHTML = "";
    }
}
