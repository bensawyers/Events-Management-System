/**
 * filters the table on the events page based on the category.
 */
function filter(data) {
  // Declare variables
  var input, filter, table, tr, td, i;
  table = document.getElementById("mainTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML == data) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

/**
 * Sorts the table on the events page based on date ascending.
 */
function sortDateAsc() {
  var table, tr, switching, i, x, y, x_date, y_date, shouldSwitch;
  table = document.getElementById("mainTable");
  switching = true;

  while (switching) {

    switching = false;
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < (tr.length - 1); i++) {
      shouldSwitch = false;
      x = tr[i].getElementsByTagName("td")[4];
      y = tr[i + 1].getElementsByTagName("td")[4];
      x = x.innerHTML;
      y = y.innerHTML;
      x = x.replace(/\s/,"T");
      x = x.replace(/\s/,"T");
      x_date = new Date(x);
      y_date = new Date(y);
      x_date = x_date.valueOf();
      y_date = y_date.valueOf();
          if (x_date < y_date) {
             shouldSwitch= true;
             break;
           }
    }
    if (shouldSwitch) {
      tr[i].parentNode.insertBefore(tr[i + 1], tr[i]);
      switching = true;
    }
  }
}

/**
 * Sorts the table on the events page based on date descending.
 */
function sortDateDesc() {
  var table, tr, switching, i, x, y, x_date, y_date, shouldSwitch;
  table = document.getElementById("mainTable");
  switching = true;

  while (switching) {

    switching = false;
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < (tr.length - 1); i++) {

      shouldSwitch = false;
      x = tr[i].getElementsByTagName("td")[4];
      y = tr[i + 1].getElementsByTagName("td")[4];
      x = x.innerHTML;
      y = y.innerHTML;
      x = x.replace(/\s/,"T");
      x = x.replace(/\s/,"T");
      x_date = new Date(x);
      y_date = new Date(y);
      x_date = x_date.valueOf();
      y_date = y_date.valueOf();

      if (x_date > y_date) {
           // I so, mark as a switch and break the loop:
             shouldSwitch= true;
             break;
           }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      tr[i].parentNode.insertBefore(tr[i + 1], tr[i]);
      switching = true;
    }
  }
}

/**
 * Sorts the table on the events page based on likeness rating ascending.
 */
function sortRating() {
  var table, tr, switching, i, x, y, x_date, y_date, shouldSwitch;
  table = document.getElementById("mainTable");
  switching = true;

  while (switching) {

    switching = false;
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < (tr.length - 1); i++) {

      shouldSwitch = false;
      x = tr[i].getElementsByTagName("td")[5];
      y = tr[i + 1].getElementsByTagName("td")[5];
      x = x.innerHTML;
      y = y.innerHTML;

      if (x < y) {
           // I so, mark as a switch and break the loop:
             shouldSwitch= true;
             break;
           }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      tr[i].parentNode.insertBefore(tr[i + 1], tr[i]);
      switching = true;
    }
  }
}
