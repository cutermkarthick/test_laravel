<!DOCTYPE html>
<html>
<head>
	<title>All MR Nos</title>
</head>
<body>

	<br>
		Please select appropriate MRS #</b>
	<br>
	<form>
	<table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
       <tr  bgcolor="#FFCC00">
            <td width=5px  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>MRS #</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>MRS Iss</b></td>
       </tr>

	</table>

	<div style="width:570px; height:270; overflow:auto;border:" id="dataList">
		<table style="table-layout: fixed" width=550px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

		<?php

            
          foreach($mrs as $myrow)
          {
          	$recnum=htmlentities($myrow->recnum);
            $doc_id=htmlentities($myrow->doc_id);
            $issue=htmlentities($myrow->issue);
          ?>
            <tr bgcolor="#FFFFFF">
             <td width=5 bgcolor="#FFFFFF"><input type="radio" name="pin" value="<?php echo $recnum."|".$doc_id."|".$issue?>"></td>
              <td width=8><span class="tabletext"><?php echo wordwrap($doc_id,15,"<br />\n",true) ?></td>
              <td width=10><span class="tabletext"><?php echo wordwrap($issue,20,"<br />\n",true) ?></td>
            </tr>
          <?php 
            }
         ?>

   </table>
 	</div>

 	<script language=javascript>

function SubmitCIM(etype) {

  var flag=0;
  var user_input;
  if(document.forms[0].pin.length)
  {
    for (i=0;i<document.forms[0].pin.length;i++) 
    {
      if (document.forms[0].pin[i].checked) 
      {
        user_input = document.forms[0].pin[i].value;
        flag=1;

      }
    }
  }
  else if(document.forms[0].pin.checked)
  {
    user_input = document.forms[0].pin.value;
    flag = 1;

  }
  if(flag == 0)
  {
    alert('Please select appropriate MRS # before submitting');
    self.close();
  }

  window.opener.Setmr(user_input,etype);
  self.close();


}

</script>

 	<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
 	</form>
</body>
</html>