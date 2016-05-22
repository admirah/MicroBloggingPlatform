function submitPost() {


    var profValid = true;
    var inputs = document.getElementsByTagName("textarea");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "" || inputs[i].value == null) profValid = false;
    }
    if (!profValid) alert("Your post can't be empty!")
    else {

        var postnovi = document.getElementsByClassName("contentpost")[0].value;
        var leftmoj = document.getElementsByClassName("left")[0].childNodes[0];
        var rightmoj = document.getElementsByClassName("right")[0].childNodes;

        var textarea = document.getElementsByClassName("contentpost")[0];
        var parent = document.getElementsByClassName("post")[1].parentNode;
        var child = document.getElementsByClassName("post")[1];

        var newchild = document.createElement("div");
        newchild.className += "post";
        var left = document.createElement("div");
        var right = document.createElement("div");
        left.className = "left";
        right.className = "right";
        var image = document.createElement("img");
        image.alt = leftmoj.alt;
        image.src = leftmoj.src;
        image.className = leftmoj.className;
        left.appendChild(image)
        newchild.appendChild(left);
        var username = document.createElement("a");
        username.href = rightmoj[1].href;
        username.className = rightmoj[1].className;
        username.innerText = rightmoj[1].innerText;
        var datum = new Date();
        var objekat = getDate(datum);

        var datenovi = document.createElement("div");

        datenovi.className = "date";
        datenovi.innerText = objekat.vrijeme;
        var datepomocni = document.createElement("div");
        datepomocni.className = "datepomocni";
        datepomocni.innerText = datum;
        var proteklo = document.createElement("div");
        proteklo.className = "proteklo";
        proteklo.innerText = objekat.proteklo;

        var contentnovi = document.createElement("div");
        contentnovi.className = "content";
        contentnovi.innerHTML = postnovi;

        right.appendChild(username);
        right.appendChild(datenovi);
        right.appendChild(datepomocni);

        right.appendChild(proteklo);

        right.appendChild(contentnovi);
        newchild.appendChild(right);

        parent.insertBefore(newchild, child);
        document.getElementsByClassName("contentpost")[0].value = "";
        return false;
    }
}


setInterval(function () {

        var datumi = document.getElementsByClassName("date");
        var datumipom = document.getElementsByClassName("datepomocni");

        var proteklo = document.getElementsByClassName("proteklo");

        for (var i = 0; i < datumipom.length; i++) {
            var objekat = getDate(datumipom[i].innerText);
            datumi[i + 1].innerText = objekat.vrijeme;
            proteklo[i].innerText = objekat.proteklo;

        }

    }
    , 100);

window.onload = function () {

    console.log("aa");
    var datumi = document.getElementsByClassName("date");
    var datumipom = document.getElementsByClassName("datepomocni");

    var proteklo = document.getElementsByClassName("proteklo");

    for (var i = 0; i < datumipom.length; i++) {
        var objekat = getDate(datumipom[i].innerText);
        datumi[i + 1].innerText = objekat.vrijeme;
        proteklo[i].innerText = objekat.proteklo;

    }

}

function getDate(mydate) {
    var datum = new Date(Date.parse(mydate));
    var trenutno = new Date(); //.getTime();
    var datum1 = (trenutno - datum) / (1000 * 60);
    var proteklo;
    datum1 = parseInt(datum1);
    var objekat = {};
    if (datum1 <= 0) {
        vrijeme = "Prije nekoliko sekundi";
        proteklo = 1;
    } else if (datum1 <= 60) {
        if (datum1 % 10 >= 1 && datum1 % 10 <= 4 && (datum1 < 10 || datum1 > 20)) vrijeme = "Prije " + datum1 + " minute";
        else vrijeme = "Prije " + datum1 + " minuta";
        proteklo = 1;
    } else {
        datum1 /= 60;
        datum1 = parseInt(datum1);
        if (datum1 <= 24) {
            if (datum1 % 10 == 1 && datum1 != 11) vrijeme = "Prije " + datum1 + " sat";
            else if (datum1 % 10 >= 2 && datum1 % 10 <= 4 && (datum1 < 10 || datum1 > 20)) vrijeme = "Prije " + datum1 + " sata";
            else vrijeme = "Prije " + datum1 + " sati";
            proteklo = 1;
        } else {
            datum1 /= 24
            datum1 = parseInt(datum1);
            if (datum1 <= 7) {
                if (datum1 == 1) {
                    vrijeme = "Prije 1 dan";
                    proteklo = 1
                } else {
                    vrijeme = "Prije " + datum1 + " dana";
                    proteklo = 2
                }
            } else {
                datum1 /= 7;
                datum1 = parseInt(datum1);

                if (datum1 <= 4) {
                    if (datum1 == 1) {
                        vrijeme = "Prije " + datum1 + " sedmice";
                        proteklo = 2
                    } else {
                        vrijeme = "Prije " + datum1 + " sedmice";
                        proteklo = 3
                    }
                } else {
                    vrijeme = mydate;
                    proteklo = 4;
                }
            }
        }
    }

    objekat.vrijeme = vrijeme;
    objekat.proteklo = proteklo;


    return objekat;
}

function show(prikaz) {
    // var postovii = document.getElementsByClassName("proteklo");

    var postovi = document.getElementsByClassName("datepomocni");
    for (var i = 0; i < postovi.length; i++) {
        var danas = new Date();
        var dana = new Date(postovi[i].innerText);

        if (prikaz == 'danas') {
            if (danas.getDay() == dana.getDay() && danas.getMonth() == dana.getMonth() && danas.getYear() == dana.getYear()) postovi[i].parentNode.parentNode.style.display = "table";
            else postovi[i].parentNode.parentNode.style.display = "none";
        } else if (prikaz == 'sedam') {
            var x = danas.getDay();
            var y = dana.getDay();
            if (x == 0) x = 7;
            if (y == 0) y = 7;
            if (x >= y && danas.getMonth() == dana.getMonth() && danas.getYear() == dana.getYear()) postovi[i].parentNode.parentNode.style.display = "table";
            else postovi[i].parentNode.parentNode.style.display = "none";
        } else if (prikaz == 'mjesec') {

            if (danas.getMonth() == dana.getMonth() && danas.getYear() == dana.getYear()) postovi[i].parentNode.parentNode.style.display = "table";
            else postovi[i].parentNode.parentNode.style.display = "none";

        } else postovi[i].parentNode.parentNode.style.display = "table";

    }


}