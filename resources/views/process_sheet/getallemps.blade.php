<!DOCTYPE html>
<html>
<head>
	<title>Employees</title>
</head>
<body>

	<br>
		Please select appropriate employee</b>
	<br>
	<form>
	<tr>&nbsp</tr>
    <tr>
        <br>
        <td><span class="tabletext">
	        <select name="emp" size="1">
		        <option selected>Please Specify
		        @foreach ($emps as $emp)
		        <option value="{{$emp->recnum}}"> <?php echo $emp->fname .' '. $emp->lname; ?></option>
		        @endforeach
	        </select>
        </td>
    </tr>

    <script language=javascript>
	function SubmitEmp(etype) {
		var ind = document.forms[0].emp.selectedIndex;
	    window.opener.SetEmp1(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
		if (ind == 0) 
		{ alert("Please select an employee");
		  return false;
		}
		self.close();
	}

	</script>

    <input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">
  	</form>
</body>
</html>