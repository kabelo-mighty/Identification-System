

    
function validateForm() 
{
var nerror=document.getElementById("nerror");
var serror=document.getElementById("serror");
var gerror=document.getElementById("gerror");
var cerror=document.getElementById("cerror");
var error=document.getElementById("error");
var iderror=document.getElementById("iderror");
var keenfname=document.getElementById("keenfname");
    var keenlname=document.getElementById("keenlname");
    var keenphone=document.getElementById("keenphone");
    var keenemail=document.getElementById("keenemail");
    var keenhouse=document.getElementById("keenhouse");
        var keenstreet=document.getElementById("keenstreet");
        var keensuburb=document.getElementById("keensuburb");
        var keencity=document.getElementById("keencity");
        var keenprovince=document.getElementById("keenprovince");
        var keenzipcode=document.getElementById("keenzipcode");
        var keencountry=document.getElementById("keencountry");
        var citerror=document.getElementById("citerror");

var errormessage=document.getElementById("errorpass");
var ierror=document.getElementById("ierror");

if(document.forms["form"]["name"].value==""&&
 document.forms["form"]["surname"].value==""&&
 document.forms["form"]["gender"].value==""&&
 document.forms["form"]["idno"].value==""&&
 document.forms["form"]["cellno"].value==""&&
 document.forms["form"]["email"].value==""&&
 document.forms["form"]["pwd"].value=="" &&
 document.forms["form"]["cpwd"].value==""&&
 document.forms["form"]["keenfirstname"].value==""&&
 document.forms["form"]["keenlastname"].value==""&&
 document.forms["form"]["kphone"].value==""&&
 document.forms["form"]["kemail"].value==""&&
 document.forms["form"]["houseno"].value==""&&
     document.forms["form"]["streetname"].value==""&&
     document.forms["form"]["suburb"].value==""&&
     document.forms["form"]["city"].value==""&&
     document.forms["form"]["province"].value==""&&
     document.forms["form"]["zipcode"].value==""&& 
     document.forms["form"]["country"].value==""&&
     document.forms["form"]["selector"].value==""
 )
{

nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
doberror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" select Date of birth. *</span>"
gerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" select gender please!*</span>"
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty*</span>"
error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
citerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" specify  if youre a south african citizen or not. *</span>"
keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"

return false;


}else{

//name 
var name=document.forms["form"]["name"].value;


if(name=="")
{

   nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}else if(!name.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

nerror.innerHTML=""; 
}
//surname

var surname=document.forms["form"]["surname"].value;


if(surname=="")
{

   serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!surname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
{
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

serror.innerHTML="";  
}
//id


var Idno=document.forms["form"]["idno"].value;


var dob=document.forms["form"]["dob"].value;

if(dob=="")
{
   doberror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"select Date of birth.*</span>";
   return false;
}else
{

    doberror.innerHTML="";
}

var year=document.getElementById('dob').value;
        var month=document.getElementById('dob').value;
        var day=document.getElementById('dob').value;
        //day.substring(7,5)
         var id=year.substring(2,4)+ month.substring(7,5)+day.substring(10,8);

        document.getElementById('dob1').value = id;
if(Idno=="")
{

  iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty. *</span>"
return false;

}else
if(Idno.toString().length!=7)
{

iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Please check the field length,it should be 7. *</span>"
return false;

}
else 
if(!Idno.match(/^[0-9]+$/))
{

iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be filled with number only. *</span>"
return false;  
}else
{
    iderror.innerHTML=""; 
}
//addtional

      
        //add2

        var cit=Idno.substring(5,4);
   if(cit!="0")
   {
 
   iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid Id Number,Youre not a RSA citizen. *</span>"
return false;    
   }

var cite=Idno.substring(6,5);
   if(cite!="8")
   {
    iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid Rsa Id Number. *</span>"
return false;    
   }   
  else
{
  iderror.innerHTML="";

}

//addtional

//check year


var gender=Idno.substring(0,1);


if(gender <= "4")
{
  
  document.forms["form"]["gender"].value="Female";


}else
{

  document.forms["form"]["gender"].value="Male";
 
}

//gender
var gender=document.forms["form"]["gender"].value;


if(gender=="")
{

   gerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Gender missing *</span>";
  return false;


}else
{

gerror.innerHTML="";  
}


//cellno
var cellno=document.forms["form"]["cellno"].value;

if(cellno=="")
{

   cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
if(cellno.substring(0,3)!='071'&& cellno.substring(0,3)!='072'&&
   cellno.substring(0,3)!='073'&& cellno.substring(0,3)!='074'&&
   cellno.substring(0,3)!='076'&& cellno.substring(0,3)!='060'&&
   cellno.substring(0,3)!='078'&& cellno.substring(0,3)!='079'&&
   cellno.substring(0,3)!='061'&& cellno.substring(0,3)!='062'&&
   cellno.substring(0,3)!='063'&& cellno.substring(0,3)!='064'&&
   cellno.substring(0,3)!='065'&& cellno.substring(0,3)!='066'&&
   cellno.substring(0,3)!='067'&& cellno.substring(0,3)!='068'&& 
   cellno.substring(0,3)!='083'&& cellno.substring(0,3)!='084')
   {

 cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Surfix of phone number invalid. *</span>"
    return false;
   
}
else if(cellno.substring(0,1)!="0")
{


cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" cellno number must start with 0.*</span>";
return false;
}
else
if(!cellno.match(/^[0-9]+$/))
{

cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cellno.toString().length!=10)
{
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be 10 characters.*</span>";    

return false;   
}
else
{
cerror.innerHTML="";

}
//
var accounttype=document.forms["form"]["selector"].value;
if(accounttype=="")
{

    citerror.innerHTML="<span style='color:red;''>"+"Specify if you are rsa citizen.*</span>";
  return false;


}else
{

    citerror.innerHTML="";  
}

 //house no
 var houseno=document.forms["form"]["houseno"].value;
 if(houseno=="")
 {
 
    keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!houseno.match(/^[0-9]+$/))
 {
     keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain numeric characters only.*</span>";
 return false;
 
 }else
 {
 
     keenhouse.innerHTML="";  
 }
 //streetname
 var streetname=document.forms["form"]["streetname"].value;
 if(streetname=="")
 {
 
     keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!streetname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
 {
     keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
 return false;
 
 }else
 {
 
     keenstreet.innerHTML="";  
 }
 //suburb
 var suburb=document.forms["form"]["suburb"].value;
 if(suburb=="")
 {
 
     keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!suburb.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
 {
     keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
 return false;
 
 }else
 {
 
     keensuburb.innerHTML="";  
 }
 //city
 
 var city=document.forms["form"]["city"].value;
 if(city=="")
 {
 
     keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!city.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
 {
     keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
 return false;
 
 }else
 {
 
     keencity.innerHTML="";  
 }
 //province
 var province=document.forms["form"]["province"].value;
 if(province=="")
 {
 
     keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!province.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
 {
     keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
 return false;
 
 }else
 {
 
     keenprovince.innerHTML="";  
 }
 
 //zipcode
 
  var zipcode=document.forms["form"]["zipcode"].value;
 if(zipcode=="")
 {
 
     keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!zipcode.match(/^[0-9]+$/))
 {
     keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain numeric characters only.*</span>";
 return false;
 
 }else
 {
 
     keenzipcode.innerHTML="";  
 }

 var country=document.forms["form"]["country"].value;
 if(country=="")
 {
 
     keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
   return false;
 
 }
 else if(!country.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
 {
   keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
 return false;
 
 }else
 {
 
     keenzipcode.innerHTML="";  
 }
   //fname 
var keenfirstname=document.forms["form"]["keenfirstname"].value;


if(keenfirstname=="")
{

 keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
return false;

}else if(!keenfirstname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
 keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

 keenfname.innerHTML=""; 
}
//lname

var keenl=document.forms["form"]["keenlastname"].value;


if(keenl=="")
{

 keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
return false;

}
else if(!keenl.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
{
 keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

 keenlname.innerHTML="";  
}
//phone
var cell=document.forms["form"]["kphone"].value;

if(cell=="")
{

 keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
return false;

}
if(cell.substring(0,3)!='071'&& cell.substring(0,3)!='072'&&
cell.substring(0,3)!='073'&& cell.substring(0,3)!='074'&&
cell.substring(0,3)!='076'&& cell.substring(0,3)!='060'&&
cell.substring(0,3)!='078'&& cell.substring(0,3)!='079'&&
cell.substring(0,3)!='061'&& cell.substring(0,3)!='062'&&
cell.substring(0,3)!='063'&& cell.substring(0,3)!='064'&&
cell.substring(0,3)!='065'&& cell.substring(0,3)!='066'&&
cell.substring(0,3)!='067'&& cell.substring(0,3)!='068'&& 
cell.substring(0,3)!='083'&& cell.substring(0,3)!='084')
{

 keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Surfix of phone number invalid. *</span>"
 return false;

}
else if(cell.substring(0,1)!="0")
{


 keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" cellno number must start with 0.*</span>";
return false;
}
else
if(!cell.match(/^[0-9]+$/))
{

 keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cell.toString().length!=10)
{
 keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be 10 characters.*</span>";    

return false;   
}
else
{
 keenphone.innerHTML="";

}



//email
var ke=document.forms["form"]["kemail"].value;

if(ke=="")
{

 keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
return false;

}
else
if(!((ke.indexOf(".") > 0) && (ke.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(ke))
{
 ke.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Invalid email.*</span>";

return false;
}else if(ke.slice(-3)!="com" && ke.slice(-5)!="ac.za" && ke.slice(-6)!="gov.za" && ke.slice(-3)!="org" && ke.slice(-5)!="co.za")
{
 keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Invalid email.*</span>";

return false;
}
else
{
 keenemail.innerHTML="";
}

//
//email


var email=document.forms["form"]["email"].value;

if(email=="")
{

   error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else
if(!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(email))
{
error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}else if(email.slice(-3)!="com" && email.slice(-5)!="ac.za" && email.slice(-6)!="gov.za" && email.slice(-3)!="org" && email.slice(-5)!="co.za")
{
  error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}
else
{
error.innerHTML="";
}





//
var passd=document.forms["form"]["pwd"].value;
var cpassd=document.forms["form"]["cpwd"].value;




var cerrormessage=document.getElementById("cerrorpass");
var pass=document.getElementById("pwd").value;

if(pass=="")
{

   errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}else
{
errormessage.innerHTML="";
}
//contain atleast 1 lowercase

if(!pass.match(/^(?=.*[a-z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 lowercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 uppercase
if(!pass.match(/^(?=.*[A-Z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 uppercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 numeric
if(!pass.match(/^(?=.*[0-9])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 numeric character.*</span>"
return false;
}
else
{
errormessage.innerHTML="";
}
//contain special character
if(!pass.match(/^(?=.*[!@#\$%\^&\*])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain special character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain 8 or more characters
if(!pass.match(/^(?=.{8,})/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password shouldcontain 8 or more characters.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//confirm password
//step 1
if(cpassd==""){

cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" confirm Password.*</span>";
return false;   
}else
{

cerrormessage.innerHTML="";
}




if(cpassd!=passd){

errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
return false;   
}else
{
errormessage.innerHTML=""
cerrormessage.innerHTML=""
}






}
}

