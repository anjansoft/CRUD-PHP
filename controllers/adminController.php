<?php
Class adminController extends _Controller {
	 
	public function indexAction(){
	$_SESSION['user_id']='1';
	$admin = $this->load->model('adminModel');
	$survey_id=$admin->getLatestSurveyID(); 
	$result = $admin->loadQuestion($survey_id);
	$this->load->view('admin',$result);	
	}
	
	public function addQuestionAction(){ 
		$user_id = $_SESSION['user_id']; 
		$admin = $this->load->model('adminModel');
		$survey_id=$admin->getLatestSurveyID(); 
		$question = $this->set->post('question');
		$question=strip_tags($question);
		$question=htmlspecialchars($question);
		$question=mysqli_real_escape_string($question);	 
		$question_type = $this->set->post('question_type');
		$options = $this->set->post('option');		
		$admin->questionsurveynew($survey_id,$question,$question_type,$options,$user_id);  
		 header("Location:" . BASE_URL.'admin/index');
	}
	 
	public function questiondeleteAction(){
		$admin = $this->load->model('adminModel');
		$survey_id = $this->set->get('survey_id');
		$admin->questiondelete($survey_id);
	}	 
	
	public function answerdeleteAction(){
		$admin = $this->load->model('adminModel');
		$answer_id = $this->set->get('answer_id');
		$admin->answerdelete($answer_id);
	}
}
?>