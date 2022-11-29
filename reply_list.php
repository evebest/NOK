<?php 
    $sql = "SELECT b.nickname, a.reply, a.regdate FROM (SELECT * FROM reply WHERE post_id=".$post_id.") a JOIN user b ON a.user_id=b.id";
    $result = mysqli_query($conn, $sql);                
    while($row = mysqli_fetch_array($result)) {
?>
<p><?php echo $row['nickname']?></p>
<p><?php echo $row['reply']?></p>
<p><?php echo $row['regdate']?></p>
<?php } ?>