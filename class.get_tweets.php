<?php class get_tweets extends TwitterOAuth{

 
function getEm($max_id, $count){
//real 
//if($count <3200){
if($count <200){ //less for testing 
if($max_id == ''){
$response = $this->get('statuses/user_timeline',array('count' => '200', 'include_entities'=>'true'));}
else{
$response = $this->get('statuses/user_timeline',array('count' => '200', 'include_entities'=>'true','max_id'=>$max_id));}


if (!is_string($response)) {

foreach($response as $t) {
$i = $t->id;
    // grabs the tweets
  $text = $t->text;
  $date = $t->created_at;
  $date = explode(' ', $date);
  //day
  
    //mon
  $month =  $date['1'];
  //yr
  $year = $date['5'];
  $date = ltrim($date['2'], '0');
  



  $img =  $t->entities->media[0]->media_url;
  $_SESSION['tweetsArray'][$i] = array('text'=>$text, 'date'=>$date, 'month'=>$month, 'year'=>$year, 'img'=>$img);
	   ///*/
}



  }
  else{
 

  echo $response.'is strring';

} 


$max_id = $t->id -1;
//echo '<b>'.$count.'</b><br>';
$this->getEm($max_id, $count=$count+200);


}
else{$_SESSION['done'] =1;}

}


public function showTweets(){


ksort($_SESSION['tweetsArray']);//first is last

//init vars
$i=0;
$date = '';
$month = '';
$year = '';


foreach($_SESSION['tweetsArray'] as $topKey => $subArray){


$text = $subArray['text'];

 	if ($year != $subArray['year']) {
        echo '<h1>' . $subArray['year'] . "</h1>";
        $year = $subArray['year'];
       }
    
     if ($month != $subArray['month']) {
        echo '<h2>' . $subArray['month'] . "</h2><hr>";
        $month = $subArray['month'];
    }
       
     if ($date != $subArray['date']) {
        echo '<h3>' . $subArray['date'] . "</h3>";
        $date = $subArray['date'];
    }
   
    

echo '<div class = "tweet" id="'.$i.'">';

echo  $subArray['text'].'<br>';


if($subArray['img'] !=''){

echo  '<img src ="'.$subArray['img'].'"/><br>';

}

echo'</div>';



//echo $subArray['test'].'<br>';

$i++;
}




}
public function showFooter(){
echo '</div>
<footer class = "footer">
<div class = "container">
<p>Site by <a href = "http://www.stephenbreighner.com/">Steve B</a></p>
<<<<<<< HEAD
<p>Check out the project at <a href ="https://github.com/sb5/twittr_mems">github</a></p>
=======
<p>Check out the project at <a href ="https://github.com/sb5/twitter_mems">github</a></p>
>>>>>>> ffeeeb97ec3e500e4efcf6a09fe9cfeb24a0abd4
<p>*max limit of 3,200 tweets I\'m afraid</p></div>
</footer>';}

  }
 




