<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>div{ padding:5px;} .form-control{width:500px;} .container{width:800px} .error{color:red; font-size:10px;}</style>
  <script src="assets/js/jquery.validate.js"></script>
</head>
<body style="background-color: #dcdcdc;">
<br/>
<div class="container" style="background-color: #fff;">
<h3>Customer Satisfaction & Feedback Survey</h2> 
<hr/>
<form action="index.php?survey/save" class=".form-horizontal" id="surveyForm" name="surveyForm" method="post">
 <div class="form-group"> 
    <input type="email" class="form-control" width="100px" id="email_id" name="email_id" required placeholder="Email ID">
  </div>
  <div class="form-group"> 
    <input type="text" class="form-control" id="full_name" name="full_name" required placeholder="Full Name">
  </div>
  <div class="form-group"> 
    <input type="text" class="form-control" id="contact_number" name="contact_number" required placeholder="Contact Number">
  </div>

<hr/>
<?php for($i=0;$i < sizeof($data['survey']); $i++)
{ ?>
<div>
<?php
if (is_array($data['survey'])){
?>
<div>
<?php
echo ($i+1).".".$data['survey'][$i]['question_name']; 
?>
</div>
<div>
<?php 
if ($data['survey'][$i]['question_type'] == 1){
foreach($data[$data['survey'][$i]['question_id']] as $row){
?> 
<input name="Q<?php echo $data['survey'][$i]['question_id']?>" required id="<?php echo $row['answer_id'];?>" value="<?php echo $row['answer_id'];?>" type='radio'/><?php echo $row['answer_name'];?>
 <?php
} 
}
else if ($data['survey'][$i]['question_type'] == 2){
?>
<div>
<textarea name="Q<?php echo $data['survey'][$i]['question_id']?>" required cols="60" rows="6"> </textarea>
</div>
<?php
}
else{
foreach($data[$data['survey'][$i]['question_id']] as $row){
?>
<input name="Q<?php echo $data['survey'][$i]['question_id']?>[]" required id="<?php echo $row['answer_id'];?>" value="<?php echo $row['answer_id'];?>" type='checkbox'/><?php echo $row['answer_name'];?><br/>
  
 <?php
}
}
?>
</div>
<?php
}
?>
</div> 

<?php 
}
 
?>
<input type="hidden" name="survey_id" value="<?php echo $data['survey_id']?>">
<center><input type="submit" class="btn btn-info" value="SUBMIT"></center>
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
</form>
</body>
</html>