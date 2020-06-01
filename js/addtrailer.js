function validaForm() {
    if (document.addMovie.title.value=="") {
    alert("Insert Title");
    return false;
    }
    if (document.addMovie.description.value=="") {
    alert("Insert Plot");
    return false;
    }
    if (document.addMovie.director.value=="") {
    alert("Insert Director");
    return false;
    }
    if (document.addMovie.year.value=="") {
    alert("Insert Year");
    return false;
    }
    var v=parseInt(document.addMovie.year.value);
    if (isNaN(v)) {
    alert("the year must be a number");
    return false;
    }
    if (document.addMovie.imdb.value=="") {
    alert("Insert IMDB Rating");
    return false;
    }
    var v1=parseInt(document.addMovie.imdb.value);
    if (isNaN(v1)) { 
    alert("IMDB Rating must be a number ");
    return false;
    }
    if ((((document.addMovie.imdb.value)%1)===0)||((document.addMovie.imdb.value)<0)||((document.addMovie.imdb.value)>10)) {
    alert("IMDB Rating must be a float between 0 and 10 ");
    return false;
    }

   if (document.addMovie.imglink.value=="") {
    alert("Insert Image Link");
    return false;
    }
   if (document.addMovie.duration.value=="") {
    alert("Insert duration of film");
    return false;
    }
    if (document.addMovie.bigimglink.value=="") {
    alert("Insert Big Image Link");
    return false;
    }

if (document.addMovie.duration.value=="") {
    alert("Insert duration of film");
    return false;
    }

var checkbox = document.getElementsByName("gen[]");
var ok = false;
for(var i=0,l=checkbox.length;i<l;i++)
{
if(checkbox[i].checked) {
ok=true;
break;
}
}

if(ok == false) {
alert("Select at least one genre");
return false;
}

alert("Data inserted correctly")
return true;

    }