<?php
Class surveyController extends _Controller {
	public function indexAction(){
		$survey = $this->load->model('surveyModel');
		$survey_id=$survey->getLatestSurveyID();
		$result = $survey->getSurvey($survey_id);
		$result['survey_id'] = $survey_id;
		$this->load->view('usersurvey',$result); 
	}
	
	public function saveAction(){		
		$survey = $this->load->model('surveyModel');
		$survey_id = $this->set->post('survey_id');
		
		$user_name = $this->set->post('email_id');
		$user_name=strip_tags($user_name);
		$user_name=htmlspecialchars($user_name);
		$user_name=mysql_real_escape_string($user_name);
		
		$full_name = $this->set->post('full_name');	
		$full_name=strip_tags($full_name);
		$full_name=htmlspecialchars($full_name);
		$full_name=mysql_real_escape_string($full_name);
		
		$contact_number = $this->set->post('contact_number');
		$contact_number=strip_tags($contact_number);
		$contact_number=htmlspecialchars($contact_number);
		$contact_number=mysql_real_escape_string($contact_number);
		
		$result = $survey->getSurvey($survey_id); 		
		$user_id=$survey->saveUser($user_name,$full_name,$contact_number);
		 
		$survey->saveSurvey($user_id,$survey_id); 
		for($i=0;$i < sizeof($result['survey']); $i++){ 
			$question_id=$result['survey'][$i]['question_id'];			
			if ($result['survey'][$i]['question_type'] == 1){ 
			  $answer_id=mysql_real_escape_string($_POST['Q'.$question_id]);
			  $survey->saveSurveyAnswers($user_id,$survey_id,$question_id,$answer_id,1,'');
			}	
			elseif($result['survey'][$i]['question_type'] == 2)
			{
			  $answer=strip_tags($_POST['Q'.$question_id]);
			  $answer=htmlspecialchars($answer);
			  $answer=mysql_real_escape_string($answer);
			  $survey->saveSurveyAnswers($user_id,$survey_id,$question_id,0,2,$answer);				
			}			
			elseif($result['survey'][$i]['question_type'] == 3)
			{
			  $answer=$_POST['Q'.$question_id];			  			  
			  foreach ($answer as $option) { 
			  if(isset($option) and $option!="") 
			  $survey->saveSurveyAnswers($user_id,$survey_id,$question_id,$option,3,'');	
			  }			  		  			
			}		
					
			} 	
		header("Location:" . BASE_URL.'index/main'); 			
		} 		
				
	}
?>