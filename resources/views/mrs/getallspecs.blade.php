<!DOCTYPE html>
<html>
<head>
	<title>Employees</title>
</head>
<body>

	<br>
		Please select appropriate spec</b>
	<br>
	<form>
	<tr>&nbsp</tr>
    
   <table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
    	<tr  bgcolor="#FFCC00">
            <td width=5px  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></span></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>Std Spec</b></span></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Std Iss</b></span></td>
       </tr>

       @foreach ($specs as $spec)
       		<tr bgcolor="#FFFFFF">
	         	<td width=5 bgcolor="#FFFFFF"><input type="radio" name="spec" value="<?php echo $spec->recnum?>|<?php echo $spec->std_no?>|<?php echo $spec->iss_of_ref?> "></td>
	          	<td width=8><span class="tabletext"><?php echo wordwrap($spec->std_no,15,"<br />\n",true) ?></td>
	          	<td width=10><span class="tabletext"><?php echo wordwrap($spec->iss_of_ref,20,"<br />\n",true) ?></td>
            </tr>
       @endforeach

    </table>

    <script language=javascript>

	function SubmitCust(etype) 
	{
	  var flag=0;
	  var user_input;
	  if(document.forms[0].spec.length)
	  {
	    for (i=0;i<document.forms[0].spec.length;i++) 
	    {
	      if (document.forms[0].spec[i].checked) 
	      {
	        user_input = document.forms[0].spec[i].value;
	        flag=1;

	      }
	    }
	  }
	  else if(document.forms[0].spec.checked)
	  {
	    user_input = document.forms[0].spec.value;
	    flag = 1;

	  }
	  if(flag == 0)
	  {
	    alert('Please select appropriate Std Spec # before submitting');
	    self.close();
	  }

	  window.opener.SetMrsno(user_input,etype);
	  self.close();


	}
	</script>

    <input type=button value="Submit" onclick=" javascript: return SubmitCust(window.name)">
  	</form>
</body>
</html>