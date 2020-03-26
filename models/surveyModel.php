<?php
Class surveyModel extends _Db{
	public function getLatestSurveyID(){
		$sql = "SELECT survey_id FROM survey ORDER BY survey_id DESC limit 0,1";
		$result['survey'] = $this->fetch_all_rows($sql);			 
		return $result['survey'][0]['survey_id']; 
	}

	public function getSurvey($survey_id){
		$sql = "SELECT * FROM survey 
				INNER JOIN survey_questions ON survey.survey_id = survey_questions.survey_id
				WHERE survey.survey_id = $survey_id order by question_id ASC";
		$result['survey'] = $this->fetch_all_rows($sql);
		if (is_array($result['survey'])){
			foreach($result['survey'] as $row){
				$sql = "SELECT * FROM survey_answers WHERE question_id = $row[question_id] order by answer_id ASC";
				$result[$row['question_id']] = $this->fetch_all_rows($sql);
			}
		}
		return $result;
	}
	
	public function alreadytaken($user_id, $survey_id){
		$sql = "SELECT * FROM user_survey_answers WHERE user_id = $user_id AND survey_id = $survey_id";
		return $this->fetch_all_rows($sql);
	}	

	public function saveUser($user_name,$full_name,$contact_number){	 
		$date = date("Y-m-d"); 
		$token = $this->generate_uuid();
        $user_token = substr($token[0]['UUID()'], 0, 8);
		$this->insert('users',array('date_created'=>"'$date'",'full_name'=>"'$full_name'",'user_name'=>"'$user_name'",'contact_number'=>"'$contact_number'",'user_token'=>"'$user_token'")); 
		$result = $this->fetch_all_rows("select user_id from users WHERE user_token = '$user_token'");  
		return $result[0]['user_id'];
	}
	
	public function generate_uuid() {
        $sql = "SELECT UUID()";
        return $this->fetch_all_rows($sql);
    }
	
	public function saveSurvey( $user_id, $survey_id){	 
		$date = date("Y-m-d"); 
		$this->insert('user_survey',array('date_submitted'=>"'$date'",'user_id'=>$user_id,'survey_id'=>$survey_id)); 
	}
	
	public function saveSurveyAnswers( $user_id, $survey_id, $question_id,$answer_id,$question_type,$answer){	 
		$date = date("Y-m-d");   			 
		$this->insert('user_survey_answers',array('user_id'=>$user_id,'question_id'=>$question_id,
											  'answer_id'=>$answer_id,
											  'survey_id'=>$survey_id,
											  'question_type'=>$question_type,
											  'essay'=>"'".$answer."'")); 
		
	}
	
    public function loadsurvey($from, $to) {
        if ($from != '' && $to != '') {
            $WHERE = " LEFT JOIN department ON survey.department_id = department.department_id WHERE survey_from >= '$from' AND survey_to <= '$to'  ORDER BY survey_id ASC";
        } else {
            $WHERE = " LEFT JOIN department ON survey.department_id = department.department_id /*WHERE CURDATE() BETWEEN survey_from AND survey_to*/ ORDER BY survey_id ASC";
        }
        $sql = "select * from survey $WHERE ";
        return $this->fetch_all_rows($sql);
    }
}

?>