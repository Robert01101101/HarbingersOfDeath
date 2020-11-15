<?php

//Get omens for members
$userLoggedIn = isset($_SESSION['user']);
$user; 
$userExperiencedOmen;
$addOmenString = "I have experienced this omen &rarr;";
$nameString = "submit_user_omen";
$style = "";
$omenTitle = $arguments["title"];

if ($userLoggedIn){
    //Check if user experienced this omen
    $DBHOST = "localhost"; $DBUSER = "root";  $DBPASS = ""; $DBNAME = "robert_michels";
    $connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
    $user = $_SESSION['user'];
    if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

    $query = "SELECT * FROM `user_omen` WHERE user_omen.user_id = '".$user->getId()."' AND user_omen.omen_id = '".$arguments["slug"]."';";
    $result = mysqli_query($connection, $query);

    //echo $query;

    if (mysqli_num_rows($result)>0){
        //user has added omen already
        $addOmenString = "I have not experienced this omen &rarr;";
        $nameString = "submit_user_omen_remove";
        $style = "input__submit--destructive";
        $omenTitle = $arguments["statement"];
    } 
}

?>

<section class="hero--omen">
    <div class="layout layout--distant">
        <h1><span class="omenTitle"><?= $arguments["title"] ?></span><?= $arguments["death"] ?></h1>

        <?php if(isset($_SESSION['user'])) : ?>
            <form method="post">
            <input type="submit" name="<?php echo $nameString ?>" value="<?php echo $addOmenString ?>" class="input__submit input__submit--omen <?php echo $style ?>">
            </form>
            <br>
        <?php endif; ?>
    </div>

</section>
