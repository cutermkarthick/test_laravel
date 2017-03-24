<!DOCTYPE html>
<html>
<head>
	<title>Employees</title>
</head>
<body>

	<br>
		Please select appropriate Process sheet</b>
	<br>
	<form>
	<tr>&nbsp</tr>
    
   <table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
    	<tr  bgcolor="#FFCC00">
            <td width=5px  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></span></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>PS #</b></span></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>PS Iss</b></span></td>
       </tr>
    </table>

    <div style="width:570px; height:270; overflow:auto;border:" id="dataList" >
    	<table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
	        @foreach ($process_sheets as $ps)
	       		<tr bgcolor="#FFFFFF">
		         	<td width=5 bgcolor="#FFFFFF"><input type="radio" name="ps" value="<?php echo $ps->recnum?>|<?php echo $ps->bomnum?>|<?php echo $ps->issue?> "></td>
		          	<td width=8><span class="tabletext"><?php echo wordwrap($ps->bomnum,15,"<br />\n",true) ?></td>
		          	<td width=10><span class="tabletext"><?php echo wordwrap($ps->issue,20,"<br />\n",true) ?></td>
	            </tr>
	        @endforeach

    	</table>
 	</div>

    </table>

    <script language=javascript>
		function SubmitCust(etype) 
		{
		  
		  var flag=0;
		  var user_input;
		  if(document.forms[0].ps.length)
		  {
		    for (i=0;i<document.forms[0].ps.length;i++) 
		    {
		      if (document.forms[0].ps[i].checked) 
		      {
		        user_input = document.forms[0].ps[i].value;
		        flag=1;

		      }
		    }
		  }
		  else if(document.forms[0].ps.checked)
		  {
		    user_input = document.forms[0].ps.value;
		    flag = 1;

		  }
		  if(flag == 0)
		  {
		    alert('Please select appropriate PS # before submitting');
		    self.close();
		  }

		  window.opener.SetPSno(user_input,etype);
		  self.close();
		}
	</script>

	<input type=button value="Submit" onclick=" javascript: return SubmitCust(window.name)">
  	</form>
</body>
</html>