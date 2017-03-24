function check_req_fields()
{
  //alert ('function working');
  //return false;
    var errmsg = '';
    if (document.forms[0].CIM_refnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter PIN\n';
    }

    if (document.forms[0].partname.value.length == 0)
    {
         errmsg += 'Please enter Partname\n';
    }
    if (document.forms[0].partnum.value.length == 0)
    {
         errmsg += 'Please enter Partnum\n';
    }
    if (document.forms[0].mrnum.value.length == 0)
    {
         errmsg += 'Please enter MR number\n';
         var docid = "";
    }
    else
    {
        var docid = document.forms[0].mrnum.value;
    }



    var pagename = document.getElementById('pagename').value ;
    

    if(pagename == 'edit_master_data')
    { 

      var prevstatus =  document.forms[0].prevstatus.value;
        
        if (document.forms[0].notes.value =='')
        {
          errmsg +="Please Enter Notes\n";
        }

      if(document.getElementById('status').value =='Active')
      {
        if(document.getElementById('qa_approved').value !='yes' || document.getElementById('approved').value !='yes' )    
        {
          errmsg += 'Sales and QA approval has to be done to change the status to Active' + '\n';
        }
      }
      if(document.getElementById('status').value =='Pending')
      {
        if(document.getElementById('qa_approved').value =='yes' && document.getElementById('approved').value =='yes' )    
        {
          errmsg += 'Please change the status to Active' + '\n';
        }
      }
      else if(document.getElementById('status').value =='Cancelled' )
      {
        if(document.getElementById('qa_approved').value =='yes' && document.getElementById('approved').value =='yes' )    
        {
          errmsg += 'Please change the status to Active' + '\n';
        }
      }
      else if(document.getElementById('status').value =='Inactive')
      {
        if (prevstatus != "Active") 
        {
          if(document.getElementById('qa_approved').value =='yes' && document.getElementById('approved').value =='yes' )    
          {
            errmsg += 'Please change the status to Active' + '\n';
          }
        }
      }

    }

    // if (docid != "") 
    // {
    //   var cnt = document.getElementById("row_cnt").value;
    //   var spec = [];
    //   for (i = 1; i < cnt; i++) 
    //   { 
    //      var s_val = document.getElementById("spec"+ i).value;
    //       spec.push(s_val);
    //   }
    // }

  
 
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }



}

function setappval()
{
  if(document.getElementById('approved').checked == true )
  {
    document.getElementById('ppc_app_date').value = document.getElementById('tod_date').value ;
    document.getElementById('approved_by').value = document.getElementById('userid').value ;
    document.getElementById('approved').value ='yes' ;

  }
  else
  {
    document.getElementById('ppc_app_date').value  ='';
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


function Getmr(rt) {

var param = rt;
var winWidth = 600;
var winHeight = 370;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("/test_laravel/getmr", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function Setmr(mrarr,fieldname) 
{


  var mrdet = mrarr.split("|");
  document.forms[0].mrrecnum.value = mrdet[0];
  document.forms[0].mrnum.value = mrdet[1];
  document.forms[0].mrissue.value = mrdet[2];

  getprocessflow4_mrdetails(mrdet[1],mrdet[0]);

}

function getprocessflow4_mrdetails(mrnum, mrrecnum)
{

          $.ajax({
              async : false,
              global : false,
              url : "getmr_li4master",
              type : "POST",
              dataType: "html", 
              data : "mrnum="+mrrecnum,
              success : function (response){
                // console.log(response);
                $('#mr_li').html(response);
              }

          });
}

function onSelectStatus()
{
   var aind = document.forms[0].statusval.selectedIndex;
   document.forms[0].status.value = document.forms[0].statusval[aind].text;
}