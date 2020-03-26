<?php

Class adminModel extends _Db {
   
	public function getLatestSurveyID(){
		$sql = "SELECT survey_id FROM survey ORDER BY survey_id DESC limit 0,1";
		$result['survey'] = $this->fetch_all_rows($sql);			 
		return $result['survey'][0]['survey_id']; 
	}
	    
    public function questionsurveynew($survey_id, $question_name, $question_type=0, $data, $user_id) {       
        $question_code = $this->generate_uuid();
        $question_code = substr($question_code[0]['UUID()'], 0, 8);
        $this->insert('survey_questions', array('survey_id' => $survey_id, 'question_name' => "'$question_name'", 'question_code' => "'$question_code'", 'question_type' => $question_type));
        $result = $this->fetch_all_rows("select question_id from survey_questions WHERE question_code = '$question_code'");        
        foreach ($data as $option) { 
         if(isset($option) and $option!="")	
         $this->insert('survey_answers', array('question_id' => $result[0]['question_id'], 'answer_name' => "'$option'"));      
        }		 
    }  

    public function loadQuestion($survey_id) {
        $sql = "SELECT  * FROM survey_questions WHERE survey_id =" . $survey_id . " ORDER BY question_id ASC";
        $result['survey'] = $this->fetch_all_rows($sql);
        if (is_array($result['survey'])) {
            foreach ($result['survey'] as $row) {
                $sql = "SELECT * FROM survey_answers WHERE question_id = $row[question_id] order by answer_id ASC";
                $result[$row['question_id']] = $this->fetch_all_rows($sql);
            }
        }
        return $result; 
    }
	
	public function generate_uuid() {
        $sql = "SELECT UUID()";
        return $this->fetch_all_rows($sql);
    }
	
    public function questiondelete($survey_id) { 
        $sql = "DELETE FROM survey WHERE survey_id = $survey_id";
        $this->query($sql);
    } 

    public function answerdelete($answer_id) {
        $this->query("DELETE FROM survey_answers WHERE answer_id = $answer_id");
    } 

    public function allowedtocheck($user_id) {
        return $this->query("SELECT * FROM users WHERE user_id = $user_id");
    }

}