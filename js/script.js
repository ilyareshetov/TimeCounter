function updater(m, s, A) {
  var baseTime = new Date();
  var period = A*60*1000;

  function update() {
        var cur = new Date();
        var diff = period - (cur - baseTime) % period;
        var millis = diff % 1000;
        diff = Math.floor(diff/1000);
        var sec = diff % 60;
        if(sec < 10) sec = "0"+sec;
        diff = Math.floor(diff/60);
        var min = diff % 60;
        if(min < 10) min = "0"+min;
        m.innerHTML = min;
        s.innerHTML = sec;

          if(min !== "00" || sec !== "00"){
              if (isStop === 1) {
                  isStop = 0;
                  if(parseInt(min) > 10) mnoj = 0;
                  else mnoj = 0.5;
                  flag = 1;
                  alert("Time to break!");
                  document.getElementById("stop").setAttribute("disabled", "disabled");
                  document.getElementsByTagName("h2")[0].innerHTML = "Break";
                  updater(document.getElementById("minutes"), document.getElementById("seconds"), 5); //5 min = 5
              }
              else setTimeout(update, millis);
          }
          else {
              if(flag === 0) {
                flag = 1;
                alert("Time to break!");
                document.getElementById("stop").setAttribute("disabled", "disabled");
                document.getElementsByTagName("h2")[0].innerHTML = "Break";
                updater(document.getElementById("minutes"), document.getElementById("seconds"), 5); //5 min = 5
              }
              else if(flag === 1){
                    flag = 0;
                    points += mnoj;
                    mnoj = 1;
                    alert("It's time to work!");
                document.getElementById("stop").removeAttribute("desabled");
                    document.getElementsByTagName("h2")[0].innerHTML = "Now you are working on: " + getCookie("title");
                    updater(document.getElementById("minutes"), document.getElementById("seconds"), 25); //25 min = 25
                  }
              }         

  }
  setTimeout(update, 0);
}

function resetButton() {
    submit('../pages/activity.php', {
        reset: 'Ok',
        points: points
    });
}

function stopButton() {
    if(confirm("Are you sure you want to stop?")){
         isStop = 1;      
    }

}

var flag = 0;
var points = 0;
var isStop = 0;
var mnoj = 1;

window.onload = function(){
    updater(document.getElementById("minutes"), document.getElementById("seconds"), 25);

}

function buildElement(tagName, props) {
    var element = document.createElement(tagName);
    for (var propName in props) element[propName] = props[propName];
    return element;
}

function submit(link, props) {
    var form = buildElement('form', {
        method: 'post',
        action: link
    });
    for (var propName in props) form.appendChild(
        buildElement('input', {
            type: 'hidden',
            name: propName,
            value: props[propName]
        })
    );
    form.style.display = 'none';
    document.body.appendChild(form);
    form.submit();
}

/*The function to get cookie*/
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}