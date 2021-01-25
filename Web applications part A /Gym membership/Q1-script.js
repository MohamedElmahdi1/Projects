function Display() {

    if (document.getElementById("age").value >= 18 && document.getElementById("age").value <= 60) {
        alert("You are eligible to join FITGYM!");

        // get input values
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var age = document.getElementById("age").value;
        var heightFeet = document.getElementById("feet").value;
        var heightInches = document.getElementById("inches").value;
        var startDate = document.getElementById("startDate").value;

        var button = document.createElement("input");

        // get the html table

        var table = document.getElementsByTagName('table')[0];

        // add new empty row to the table
        var newRow = table.insertRow(table.rows.length);

        // add cells to the row
        var cel1 = newRow.insertCell(0);
        var cel2 = newRow.insertCell(1);
        var cel3 = newRow.insertCell(2);
        var cel4 = newRow.insertCell(3);
        var cel5 = newRow.insertCell(4);
        var cel6 = newRow.insertCell(5);

        // add values to the cells
        cel1.innerHTML = fname;
        cel2.innerHTML = lname;
        cel3.innerHTML = age;
        cel4.innerHTML = heightFeet + "'" + ' ' + heightInches + '"';
        cel5.innerHTML = startDate;
        cel6.innerHTML = '<button onclick="removeRow();">Delete Row</button>';

        deleteForm();

        var tbodyRowCount = table.tBodies[0].rows.length - 1;

        document.getElementById("p").innerHTML = "Rows: " + tbodyRowCount;
    }
    else {
        alert("You are not eligble to join FITGYM due to your age.");
        deleteForm();
    }

}

function reset() {
for (var i = table.rows.length - 1; i > 0; i--) {
    table.deleteRow(i);
}
deleteForm();

var tbodyRowCount = table.tBodies[0].rows.length - 1;

document.getElementById("p").innerHTML = "Rows: " + tbodyRowCount;
}

function deleteForm()
{
    document.getElementById('fname').value = '';
    document.getElementById('lname').value = '';
    document.getElementById('age').value = '';
    document.getElementById('feet').value = '';
    document.getElementById('inches').value = '';
    document.getElementById('startDate').value = ''; 
}
function removeRow() {
// event.target will be the input element.
var td = event.target.parentNode;
var tr = td.parentNode; // the row to be removed
tr.parentNode.removeChild(tr);

var tbodyRowCount = table.tBodies[0].rows.length - 1;

document.getElementById("p").innerHTML = "Rows: " + tbodyRowCount;
}