<?php
session_start();
require_once "../../connect/connectDb/config.php";


if (isset($_POST['post'])) {
     $postId = $_POST['post'];
     $deletePost = "UPDATE `78000_posts` SET `postVisibility`='delete' WHERE `userUniqueCode` = '" . $_SESSION['userUniqueCode'] . "' AND `postSrNo` = '$postId'";
     $fireDeletePost = mysqli_query($link, $deletePost);

     if ($fireDeletePost) {
          echo 1;
     } else {
          echo 0;
     }
}
