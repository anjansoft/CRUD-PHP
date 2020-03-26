 <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <script src="assets/js/jquery.validate.js"></script>
  <style>.error{color:red; font-size:10px;}</style>
</head>
<body> 
<div class="container">
<form class="form-horizontal" method="Post" id="surveyForm" name="surveyForm" action="index.php?admin/addQuestion">
<div id="accordion">
  <h3>Add Question</h3>
  <div>
	<p>
		
		<div class="control-group">
		<div class="inc">
		<div class="controls">
		Question <br/> <textarea name="question" rows="3" cols="80" required></textarea>
		<br/><br/>
		Type : <select name="question_type">
		<option value="1" selected> Radio</option>
		<option value="2"> Text</option>
		<option value="3"> Checkbox</option>
		</select>
		<br/><br/>
		Option: <input type="text" name="option[]"><br/><br/>
		Option: <input type="text" name="option[]"><br/><br/>
		Option: <input type="text" name="option[]"><br/><br/>
		Option: <input type="text" name="option[]"><br/><br/>
		Option: <input type="text" name="option[]"><br/><br/>
		</div>
		</div>
		<button style="margin-left: 50px" class="btn btn-info" type="submit" id="append" name="append">Add Option</button> 
		<input type="submit" class="btn btn-info" name="submit" value="submit"/> 
		</div>
		
	</p>
   </div>
  <h3>Survey Questions</h3>
  <div>
<p>  
<table width="100%" class="table">
<tr class="tr-head">
<td width="400"> <b> Question </b></td>
<td width="100"> <b> Type </b></td>
<td width="200"> <b> Options </b></td>
</tr>
<?php 
if (is_array($data['survey'])){
foreach($data['survey'] as $row){		 
?>
<tr>
<td class="line"> 
<?php echo $row['question_name'];?> 
</td>
<td>
<?php 
if($row['question_type'] == 1 ) echo 'Radiobutton';
elseif($row['question_type'] == 2 ) echo'Text' ;
elseif($row['question_type'] == 3 ) echo'Checkbox' ;
?>
</td>
<td> 
<table width="100%">
<?php 
if(is_array($data[$row['question_id']])){
foreach ($data[$row['question_id']] as $row2){ 
?> 
<tr>
<td width="150" class="line">
 <?php echo $row2['answer_name'] ?>
 </td>
</tr>
<?php 
}  
}
?>
</table> 
</td>
</tr>
<?php
}
}
?>
</table>
 </p>
</div>
  
</div>

 </form>

</div>
 <script>
$.validator.setDefaults({
submitHandler: function() {
	var form = $('#surveyForm');
	var action = $(this).data('action');
    form.attr('action', action); 
    form.submit();	 
}
});

$().ready(function() {		 
$("#surveyForm").validate(); 
});
</script>
  <script>
   $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  } );
  </script>


<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
          e.preventDefault();
        $(".inc").append('<div class="controls">\
		Option: <input type="text"  name="option[]">\ <a href="#" class="remove_this btn">remove</a>\
                <br>\
                <br>\
            </div>');
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().remove();
        return false;
        });
   /* $("input[type=submit]").click(function(e) {
      e.preventDefault();
      $(this).next("[name=textbox]")
      .val(
        $.map($(".inc :text"), function(el) {
          return el.value
        }).join(",\n")
      )
    }) */
  });
  </script>
 
 </body>
</html>