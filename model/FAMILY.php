<?php
class FAMILY{
        private $family ; // = R::dispense( 'post' );
        public function __construct(){
                $this->family = R::dispense('family');
        }
        private function filterString($str){
                $newstr = filter_var($str, FILTER_SANITIZE_STRING);
                return $newstr;
        }
        private function filterInt($str){
                $newstr = filter_var($str, FILTER_VALIDATE_INT);
                if($newstr == "") return_fail("ini have to be provided");
                return $newstr;
        }
        public function register($data){
                $this->family->dad = isset($data['dad']) ? $this->filterString($data['dad']) : null;
                $this->family->mom = isset($data['mom']) ? $this->filterString($data['mom']) : null;
                $this->family->baby = isset($data['baby']) ? $this->filterString($data['baby']) : null;
                $this->family->gender = isset($data['gender']) ? $this->filterString($data['gender']) : null;
                $this->family->birthdate = isset($data['birthdate']) ? $this->filterString($data['birthdate']) : null;


                try{
                        $id = R::store($this->family);
                        return_success("family->register",$id);
                } catch(Exception $e){
                        return_fail("family->register",$e->getMessage());
                }
        }
        public function update($data){
                $id = isset($data['id']) ? $this->filterInt($data['id']) : null;
                if($id == null ) return_fail("family->update","id have to be provided");
                try{
                        $this->family = R::load('family',$id);
                }catch(Exception $e){
                        return_fail("family->update",$e->getMessage());
                }
                if($this->family->id == 0) return_fail("family->update","no record to update");
                $this->family->dad = isset($data['dad']) ? $data['dad'] : $this->family->dad;
                $this->family->mom = isset($data['mom']) ? $data['mom'] : $this->family->mom;
                $this->family->baby = isset($data['baby']) ? $data['baby'] : $this->family->baby;
                $this->family->gender = isset($data['gender']) ? $data['gender'] : $this->family->gender;
                $this->family->birthdate = isset($data['birthdate']) ? $data['birthdate'] : $this->family->birthdate;
                R::store($this->family);
                return_success("family->update","updated");
        }
        public function delete($data){
                $id = isset($data['id']) ? $this->filterInt($data['id']) : null;
                if($id == null ) return_fail("family->delete","id have to be provided");
                try{
                        $this->family = R::load('family',$id);
                }catch(Exception $e){
                        return_fail("family->update",$e->getMessage());
                }
                if($this->family->id == 0) return_fail("family->delete","no record to delete");
                // R::trash( $post ); # delete record (bean)
                R::trash($this->family);
                return_success("family->success","deleted");
        }
        public function selectAll($data){
                //$books = R::getAll('SELECT * FROM book WHERE price < ? ',[ 50 ] ); # raw query method
                $lastId = isset($data['lastId']) ? $this->filterInt($data['lastId']) : 0 ;
                $limit = isset($data['limit']) ? $this->filterInt($data['limit']) : 10;
                if($lastId != "" || $limit != "" ){
                        $familys = R::getAll('SELECT * FROM family WHERE id > ? LIMIT ?',[$lastId,$limit]);
                        if(count($familys) > 0){
                                return_success("family->selectAll",$familys);
                        } else{
                                return_fail("family->selectAll",'no data');
                        }
                } else{
                        return_fail("family->selectAll","lastId and limit have to be int ".$lastId." : ".$limit);
                }
        }
        public function selectByGender($data){
                //$books = R::getAll('SELECT * FROM book WHERE price < ? ',[ 50 ] ); # raw query method
                $lastId = isset($data['lastId']) ? $this->filterInt($data['lastId']) : 0 ;
                $limit = isset($data['limit']) ? $this->filterInt($data['limit']) : 10;
                $gender = isset($data['gender']) ? $this->filterString($data['gender']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE id > ? AND gender = ?  LIMIT ?',[$lastId,$gender,$limit]);
                if(count($familys) > 0){
                        return_success("family->selectByGender",$familys);
                } else{
                        return_fail("family->selectByGender",'no data for gender '.$gender);
                }
                
        }
        public function selectByBirthdate($data){
                //$books = R::getAll('SELECT * FROM book WHERE price < ? ',[ 50 ] ); # raw query method
                $lastId = isset($data['lastId']) ? $this->filterInt($data['lastId']) : 0 ;
                $limit = isset($data['limit']) ? $this->filterInt($data['limit']) : 10;
                $birthdate = isset($data['birthdate']) ? $this->filterString($data['birthdate']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE id > ? AND birthdate = ?  LIMIT ?',[$lastId,$birthdate,$limit]);
                if(count($familys) > 0){
                        return_success("family->selectByBirthdate",$familys);
                } else{
                        return_fail("family->selectByBirthdate",'no data for birthdate '.$birthdate);
                }
                
        }
        public function selectByGenderBirthdate($data){
                $lastId = isset($data['lastId']) ? $this->filterInt($data['lastId']) : 0 ;
                $limit = isset($data['limit']) ? $this->filterInt($data['limit']) : 10;
                $gender = isset($data['gender']) ? $this->filterString($data['gender']) : null;
                $birthdate = isset($data['birthdate']) ? $this->filterString($data['birthdate']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE id > ? AND gender = ? AND birthdate = ? LIMIT ?',[$lastId,$gender,$birthdate,$limit]);
                if(count($familys) > 0){
                        return_success("family->selectByGender",$familys);
                } else{
                        return_fail("family->selectByGender",'no data for gender '.$gender.' and birthdate '.$birthdate);
                }
        }
        public function guess($data){
                $familys = R::getAll('SELECT * FROM family');
                if(count($familys) > 0 ) {
                        $suggectedNames = $this->guessWithData($data,$familys);
                        return_success("family->guess",$suggectedNames);
                }else{
                        return_fail("family->guess","insufficient training data");
                }
        }
        public function guessForGender($data){
                $gender = isset($data['gender']) ? $this->filterString($data['gender']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE gender = ?',[$gender]);
                if(count($familys) > 0 ) {
                        $suggectedNames = $this->guessWithData($data,$familys);
                        return_success("family->guessForGender",$suggectedNames);
                }else{
                        return_fail("family->guessForGender","insufficient training data for gender ".$gender);
                }
        }
        public function guessForBirthdate($data){
                $birthdate = isset($data['birthdate']) ? $this->filterString($data['birthdate']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE birthdate = ?',[$birthdate]);
                if(count($familys) > 0 ) {
                        $suggectedNames = $this->guessWithData($data,$familys);
                        return_success("family->guessForBirthdate",$suggectedNames);
                }else{
                        return_fail("family->guessForBirthdate","insufficient training data for birthdate ".$birthdate);
                }
        }
        public function guessForGenderBirthdate($data){
                $gender = isset($data['gender']) ? $this->filterString($data['gender']) : null;
                $birthdate = isset($data['birthdate']) ? $this->filterString($data['birthdate']) : null;
                $familys = R::getAll('SELECT * FROM family WHERE gender = ? AND  birthdate = ?',[$gender,$birthdate]);
                if(count($familys) > 0 ) {
                        $suggectedNames = $this->guessWithData($data,$familys);
                        return_success("family->guessForGenderBirthdate",$suggectedNames);
                }else{
                        return_fail("family->guessForGenderBirthdate","insufficient training data for gender and birthdate  ".$gender. " : " .$birthdate);
                }
        }
        private function guessWithData($data,$familys){
                /*
                        What we have to do,

                        1. we accept dad and mom name
                        2. select all family from database
                        3. find Euclidean  distance for each family
                        4. find minimum euclidean distance and show the result :D

                */
                $diffArr = array();

                #1
                $dad = isset($data['dad']) ? $this->filterString($data['dad']) : null;
                $mom = isset($data['mom']) ? $this->filterString($data['mom']) : null;
                if($dad == null || $mom == null ) return_fail("family->guess","dad and mom names have to be provided");

                #2
                //$familys = R::getAll('SELECT * FROM family');
                //print_r($familys);

                #3
                for($i = 0 ; $i < count($familys) ; $i++){
                        //echo "loop i = ".$i;
                        //print_r($familys[$i]);
                        $dadData = $familys[$i]['dad'];
                        $momData = $familys[$i]['mom'];
                        //echo "dad Data is ".$dadData;
                        //echo "mom Data is ".$momData;
                        $dadDiff = 0;
                        $momDiff = 0;
                        $totalDiff = 0 ;
                        for($j = 0; $j < strlen($dadData); $j++){
                                if($j >= strlen($dad) ) continue;
                                $dadDiff += abs( $this->codePoint($dadData[$j]) - $this->codePoint($dad[$j]) );
                        }
                        for($j = 0; $j < strlen($momData); $j++){
                                if($j >= strlen($mom) ) continue;
                                $momDiff += abs( $this->codePoint($momData[$j]) - $this->codePoint($mom[$j]) );
                        }
                        $totalDiff = $dadDiff + $momDiff;
                        $diffArr[$i] = $totalDiff;
                }

                #4
                $oldIndex = array();
                $diffArrSort = $diffArr;
                sort($diffArrSort);
                for($i = 0; $i < count($diffArrSort); $i++){
                        //echo "for diffArrSort i ".$diffArrSort[$i];
                        for($j = 0; $j < count($diffArr); $j++){
                                //echo "for diffAarr j ".$diffArr[$j];
                                if($diffArrSort[$i] == $diffArr[$j]){
                                        //echo "Here we are same :D".$i;
                                        $oldIndex[$i] = $j; // conversation from oldindex to new index
                                        $diffArr[$j] = -1; // not to mathc again in next outer loop
                                        $j = count($diffArr); // pass the whole inner  loop
                                }
                        }
                }

                #5
                $maxResultCount = 2 ; // that's max name count
                $suggectedNames = array();
                //print_r($oldIndex);

                for($i = 0; $i < count($oldIndex); $i++){
                        $orgIndex = $oldIndex[$i];
                        $baby = $familys[$orgIndex]['baby'];
                        $suggectedNames[] = $baby;
                        if($i == $maxResultCount) $i = count($oldIndex);
                }
                return $suggectedNames;
        }
        public function guessOLD($data){
                /*
                        What we have to do,

                        1. we accept dad and mom name
                        2. select all family from database
                        3. find Euclidean  distance for each family
                        4. find minimum euclidean distance and show the result :D

                */
                $diffArr = array();

                #1
                $dad = isset($data['dad']) ? $data['dad'] : null;
                $mom = isset($data['mom']) ? $data['mom'] : null;
                if($dad == null || $mom == null ) return_fail("family->guess","dad and mom names have to be provided");

                #2
                $familys = R::getAll('SELECT * FROM family');
                //print_r($familys);

                #3
                for($i = 0 ; $i < count($familys) ; $i++){
                        //echo "loop i = ".$i;
                        //print_r($familys[$i]);
                        $dadData = $familys[$i]['dad'];
                        $momData = $familys[$i]['mom'];
                        //echo "dad Data is ".$dadData;
                        //echo "mom Data is ".$momData;
                        $dadDiff = 0;
                        $momDiff = 0;
                        $totalDiff = 0 ;
                        for($j = 0; $j < strlen($dadData); $j++){
                                if($j >= strlen($dad) ) continue;
                                $dadDiff += abs( $this->codePoint($dadData[$j]) - $this->codePoint($dad[$j]) );
                        }
                        for($j = 0; $j < strlen($momData); $j++){
                                if($j >= strlen($mom) ) continue;
                                $momDiff += abs( $this->codePoint($momData[$j]) - $this->codePoint($mom[$j]) );
                        }
                        $totalDiff = $dadDiff + $momDiff;
                        $diffArr[$i] = $totalDiff;
                }

                #4
                $oldIndex = array();
                $diffArrSort = $diffArr;
                sort($diffArrSort);
                for($i = 0; $i < count($diffArrSort); $i++){
                        //echo "for diffArrSort i ".$diffArrSort[$i];
                        for($j = 0; $j < count($diffArr); $j++){
                                //echo "for diffAarr j ".$diffArr[$j];
                                if($diffArrSort[$i] == $diffArr[$j]){
                                        //echo "Here we are same :D".$i;
                                        $oldIndex[$i] = $j; // conversation from oldindex to new index
                                        $diffArr[$j] = -1; // not to mathc again in next outer loop
                                        $j = count($diffArr); // pass the whole inner  loop
                                }
                        }
                }
                $resultCount = 3 ;
                $suggectedNames = array();
                //print_r($oldIndex);
                for($i = 0; $i < $resultCount; $i++){
                        $orgIndex = $oldIndex[$i];
                        $baby = $familys[$orgIndex]['baby'];
                        $suggectedNames[] = $baby;
                }


                return_success("family->guess",$suggectedNames);
                
        }
        /*
                Unicode Code Point Int
                https://stackoverflow.com/questions/12989697/using-php-to-find-unicode-of-a-character
        */
        public function codePoint($u) {
                $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
                $k1 = ord(substr($k, 0, 1));
                $k2 = ord(substr($k, 1, 1));
                return $k2 * 256 + $k1;
        }

        public function selectAllold(){
                $sql = "SELECT tblhospital.Code,tblhospital.Name,tblhospital.City FROM tblhospital";
                $stmt = $this->conn->prepare($sql);
                if ( false===$stmt ) {
                        return_fail('prepare_failed hospital selectAll',htmlspecialchars($this->conn->error));
                }
                $rc = $stmt->execute();
                if ( false===$rc ) {
                        return_fail('execute_failed  hospital selectAll',htmlspecialchars($this->conn->errno) .":". htmlspecialchars($stmt->error));
                }
                $result = $stmt->get_result();
                $affected_rows = $result->num_rows;
                $stmt->close();
                if($affected_rows > 0 ){
                        $data = $result->fetch_all(MYSQLI_ASSOC);
                        $return_data = array(true,$data);
                        return_success("hospital selectAll",$data);
                }else{
                        $return_data = array(false);
                        return_fail('no_data  hospital selectAll',"there is no data for that query");
                }
        }
}// end for class
?>