<?php
ob_start();
session_start();
require_once 'dbconnect.php';

$result1 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A1'");
$count1 = mysql_num_rows($result1);

$result2 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A2'");
$count2= mysql_num_rows($result2);

$result3 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A3'");
$count3 = mysql_num_rows($result3);

$result4 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A4'");
$count4 = mysql_num_rows($result4);

$result5 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A5'");
$count5 = mysql_num_rows($result5);

$result6 = mysql_query("SELECT userWorkshop1 FROM users WHERE userWorkshop1='A6'");
$count6 = mysql_num_rows($result6);

$result1b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B1'");
$count1b = mysql_num_rows($result1b);

$result2b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B2'");
$count2b= mysql_num_rows($result2b);

$result3b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B3'");
$count3b = mysql_num_rows($result3b);

$result4b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B4'");
$count4b = mysql_num_rows($result4b);

$result5b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B5'");
$count5b = mysql_num_rows($result5b);

$result6b = mysql_query("SELECT userWorkshop2 FROM users WHERE userWorkshop2='B6'");
$count6b = mysql_num_rows($result6b);

$json = file_get_contents('https://bridgeday.000webhostapp.com/max.json');
$details = json_decode($json, true);

$max1 = $details["1"];
$max2 = $details["2"];
$max3 = $details["3"];
$max4 = $details["4"];
$max5 = $details["5"];
$max6 = $details["6"];
$max1b = $details["1b"];
$max2b = $details["2b"];
$max3b = $details["3b"];
$max4b = $details["4b"];
$max5b = $details["5b"];
$max6b = $details["6b"];

if(isset($_POST['submit'])) {

  $email = strip_tags(trim($_POST['email']));
  $fname = strip_tags(trim($_POST['firstname']));
  $lname = strip_tags(trim($_POST['lastname']));
  $school = strip_tags(trim($_POST['school']));
  $teacher = strip_tags(trim($_POST['teacher']));
  $medInfo = strip_tags(trim($_POST['medInfo']));
  $emgContact = strip_tags(trim($_POST['emgContact']));
  $emgPhone = strip_tags(trim($_POST['emgPhone']));
  $learnQ = strip_tags(trim($_POST['learnQ']));
  $w1 = strip_tags(trim($_POST['work1']));
  $w2 = strip_tags(trim($_POST['work2']));

  $lunch = $_POST['lunch'];
  $gender = $_POST['gender'];

  if ($medInfo == ""){
    $medInfo = "None";
  }
  $error = false;

  if (empty($email) || empty($fname) || empty($lname)|| empty($teacher) || empty($school) || empty($emgContact) || empty($lunch) || empty($emgPhone) || empty($learnQ) || empty($gender) || empty($w1) || empty($w2)){
    $error = true;
    $errorCode = 1;
  }

  if (!$error) {
    $fname = str_replace("'", "''", "$fname");
    $fname = str_replace("\n", "", "$fname");

    $lname = str_replace("'", "''", "$lname");
    $lname = str_replace("\n", "", "$lname");

    $email = str_replace("'", "''", "$email");
    $email = str_replace("\n", "", "$email");

    $school = str_replace("'", "''", "$school");
    $school = str_replace("\n", "", "$school");

    $teacher = str_replace("'", "''", "$teacher");
    $teacher = str_replace("\n", "", "$teacher");

    $medInfo = str_replace("'", "''", "$medInfo");
    $medInfo = str_replace("\n", "", "$medInfo");

    $emgContact = str_replace("'", "''", "$emgContact");
    $emgContact = str_replace("\n", "", "$emgContact");

    $emgPhone = str_replace("'", "''", "$emgPhone");
    $emgPhone = str_replace("\n", "", "$emgPhone");

    $learnQ = str_replace("'", "''", "$learnQ");
    $learnQ = str_replace("\n", "", "$learnQ");

    $lunch = ($lunch == "Y");

    $query = "INSERT INTO users(userFName, userLName, userEmail, userSchool, userTeacher, userGender, userMedInfo, userEmgName, userEmgNum, lunch, userWorkshop1, userWorkshop2, userQResponse) VALUES('$fname', '$lname', '$email', '$school', '$teacher', '$gender', '$medInfo', '$emgContact', '$emgPhone', '$lunch', '$w1', '$w2', '$learnQ')";
    $res = mysql_query($query);

    if ($res) {
      $errorCode = 0;
    }
  }
  header("Location: https://bridgeday.000webhostapp.com?error=".$errorCode."#regThing");

}

?>

<html>

<head>
    <title>BRidge Day 2017</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"></link>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-pink.min.css" />
    <!-- Fancybox -->
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

</head>

<body>
    <!-- Fancybox popup -->
    <div class="fancybox" rel="group" id="workPopup"></div>

    <div class="overlay">
      <div class="third">
            <div class="subTitle fadeIn">Workshops</div>
            <center>
                <div class="hs101Disclaimer">Workshops are filled on a first come, first serve basis.</div>

                <div class="titleThing">Pillar 1 Workshops - Relationships</div>
                <div class="mdl-grid mdl-container">
                    <div class="mdl-cell mdl-cell--4-col" id="A1">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Make it or Break It? - Halton Women's Place</div>
                            <div class="spots"><span class="num">
                                <?php echo $max1 - $count1; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="A2">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Resisting Toxic Media - SAVIS
                            </div>
                            <div class="spots"><span class="num">
                                <?php echo $max2 - $count2; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="A3">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Live, Learn, Laugh - Kimberley Menezes-Francispillai</div>
                            <div class="spots"><span class="num">
                                <?php echo $max3 - $count3; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="A4">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Balancing Relationships - Betty Xiong, Carrie Cho</div>
                            <div class="spots"><span class="num">
                                <?php echo $max4 - $count4; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="A5">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Q &amp; A - Ron Duberstein</div>
                            <div class="spots"><span class="num">
                                <?php echo $max5 - $count5; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="A6">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Stereotypes in High School - GEM</div>
                            <div class="spots"><span class="num">
                                <?php echo $max6 - $count6; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                </div>

                <hr width="50%">

                <div class="titleThing">Pillar 2 Workshops - Resilliency</div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col" id="B1">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Mirror Mirror - Halton Women's Place</div>
                            <div class="spots"><span class="num">
                                <?php echo $max1b - $count1b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="B2">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Mental Health at The Ridge - Wellness Team</div>
                            <div class="spots"><span class="num">
                                <?php echo $max2b - $count2b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="B3">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Music As Medicine For Mental Health - Joob Vailiki</div>
                            <div class="spots"><span class="num">
                                <?php echo $max3b - $count3b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="B4">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Break down the Roles - Red Cross Youth Facilitators</div>
                            <div class="spots"><span class="num">
                                <?php echo $max4b - $count4b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="B5">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">Resolution: Confidence - Jenn Patterson</div>
                            <div class="spots"><span class="num">
                                <?php echo $max5b - $count5b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col" id="B6">
                        <div class="mdl-card-square mdl-card mdl-shadow--4dp">
                            <div class="workTitle">The Daring Way - Melissa Vance</div>
                            <div class="spots"><span class="num">
                                <?php echo $max6b - $count6b; ?> </span>
                                <br>
                                <br>spots remaining</div>
                            <div class="readMore">Read More</div>

                        </div>
                    </div>
                </div>

                <hr width="50%">


            <div class="subTitle fadeIn" id="regThing">Register for BRidge Day</div>
            <div id="errorMSG" class="fadeIn"></div>
            <center>

                <form id="reg" method='post'>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="firstname" name="firstname">
                        <label class="mdl-textfield__label" for="firstname">First Name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="lastname" name="lastname">
                        <label class="mdl-textfield__label" for="lastname">Last Name</label>
                    </div>

                    <!-- -->
                    </br>
                    </br>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="email" name="email">
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="school" name="school">
                        <label class="mdl-textfield__label" for="school">School</label>
                    </div>


                    </br>
                    </br>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="demo-show-toast">
                        <input type="radio" id="demo-show-toast" class="mdl-radio__button" name="lunch" value="Y">
                        <span class="mdl-radio__label">Cafeteria Option</span>
                    </label>

                    <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
                        <div class="mdl-snackbar__text">Test</div>
                        <button class="mdl-snackbar__action" type="button"></button>
                    </div>

                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                        <input type="radio" id="option-2" class="mdl-radio__button" name="lunch" value="N">
                        <span class="mdl-radio__label">Bringing Own Lunch</span>
                    </label>
                    <br>
                    <br>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="medInfo" name="medInfo">
                        <label class="mdl-textfield__label" for="medInfo">Medical Information (optional)</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="emgContact" name="emgContact">
                        <label class="mdl-textfield__label" for="emgContact">Emergency Contact Name</label>
                    </div>

                    <!-- -->
                    </br>
                    </br>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="emgPhone" name="emgPhone">
                        <label class="mdl-textfield__label" for="emgPhone">Emergency Contact Phone</label>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="teacher" name="teacher">
                        <label class="mdl-textfield__label" for="teacher">Teacher Advisor Name</label>
                    </div>

                    <br>
                    <br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="learnQ" name="learnQ">
                        <label class="mdl-textfield__label" for="learnQ">List 2 questions about high school</label>
                    </div>

                    </br>
                    </br>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                        <input type="radio" id="option-3" class="mdl-radio__button" name="gender" value="M">
                        <span class="mdl-radio__label">Male</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
                        <input type="radio" id="option-4" class="mdl-radio__button" name="gender" value="F">
                        <span class="mdl-radio__label">Female</span>
                    </label>

                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
                        <input type="radio" id="option-5" class="mdl-radio__button" name="gender" value="O">
                        <span class="mdl-radio__label">Other</span>
                    </label>

                    </br>
                    </br>

                    <select id="work1" name="work1" class="select-style">
                        <option value="" disabled selected>Relationship Workshop Choice</option>
<?php if ($count1 < $max1){
echo "<option value='A1'>Make it or Break It? - Halton Women's Place</option>";
}
if ($count2 < $max2) {
  echo "<<option value='A2'>Resisting Toxic Media - SAVIS</option>";
}
if ($count3 < $max3) {
  echo "<<option value='A3'>Live, Learn, Laugh - Kimberley Menezes-Francispillai</option>";
}
if ($count4 < $max4) {
  echo "<<option value='A4'>Balancing Relationships - Betty Xiong, Carrie Cho</option>";
}
if ($count5 < $max5) {
  echo "<<option value='A5'>Q&amp;A - Ron Duberstein</option>";
}
if ($count6 < $max6) {
  echo "<<option value='A6'>Stereotypes in High School - GEM</option>";
} ?>
                    </select>

                    <br/>
                    <br/>

                    <select id="work2" name="work2" class="select-style">
                        <option value="" disabled selected>Resilliency Workshop Choice</option>
<?php if ($count1b < $max1b){
echo "<option value='B1'>Mirror Mirror - Halton Women's Place</option>";
  }
if ($count2b < $max2b){
  echo "<option value='B2'>Mental Health at The Ridge - Wellness Team</option>";
}
if ($count3b < $max3b){
  echo "<option value='B3'>Music As Medicine For Mental Health - Joob Vailiki</option>";
}
if ($count4b < $max4b){
  echo "<option value='B4'>Break down the Roles - Red Cross Youth Facilitators</option>";
}
if ($count5b < $max5b){
  echo "<option value='B5'>Resolution: Confidence - Jenn Patterson</option>";
}
if ($count6b < $max6b){
  echo "<option value='B6'>The Daring Way - Melissa Vance</option>";
} ?>
                    </select>

                    </br>
                    <br>
                    <br>

                    <input id="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary" type="submit" value="Register">
                    </input>
                </form>
            </center>
        </div>

        <script type="text/javascript" src="js/jquery-latest.min.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
        <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
        <!-- fancybox -->
        <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

        <script src="js/main.js" type="text/javascript"></script>

  <script>
  (function() {
    'use strict';
    window['counter'] = 0;
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var showToastButton = document.querySelector('#demo-show-toast');
    showToastButton.addEventListener('click', function() {
      'use strict';
      var data = {
      message: '$8 paid by cheque to "Iroquois Ridge High School" for cafeteria option'
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                });
            }());
        </script>
</body>

</html>
