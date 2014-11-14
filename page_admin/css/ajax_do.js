// Get base url

url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);

function ajax_do (url) {

  // Does URL begin with http?
  if (url.substring(0, 4) != 'http') {
    url = base_url + url;
  }

  // Create new JS element
  var jsel = document.createElement('SCRIPT');
  jsel.type = 'text/javascript';
  jsel.src = url;

  // Append JS element (therefore executing the 'AJAX' call)
  document.body.appendChild (jsel);

}