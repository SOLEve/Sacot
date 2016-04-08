<script language="javascript">
	

function agregaFila()
{

  var TABLE = document.getElementById("tabla");
  var TROW = document.getElementById("celda");
  var content = TROW.getElementsByTagName("td");
  var newRow = TABLE.insertRow(-1);
  
  newRow.className = TROW.attributes['class'].value;
  var newCell = newRow.insertCell(newRow.cells.length)
  
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt

}

</script>