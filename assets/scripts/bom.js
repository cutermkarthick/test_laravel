function setappval()
{
	if(document.getElementById('approved').checked == true )
	{
		document.getElementById('app_date').value = document.getElementById('tod_date').value ;
		document.getElementById('approved_by').value = document.getElementById('userid').value ;
		document.getElementById('approved').value ='yes' ;

	}
	else
	{
		document.getElementById('app_date').value  ='';
		document.getElementById('approved_by').value = ''; 
		document.getElementById('approved_by').value = ''; 
	}
}
function setqaappval()
{
  if(document.getElementById('qa_approved').checked == true )
  {
    document.getElementById('qa_app_date').value = document.getElementById('tod_date1').value ;
    document.getElementById('qa_approved_by').value = document.getElementById('userid').value ;
    document.getElementById('qa_approved').value ='yes' ;

  }
  else
  {
    document.getElementById('qa_app_date').value  ='';
    document.getElementById('qa_approved').value = ''; 
    document.getElementById('qa_approved_by').value = ''; 
  }
}