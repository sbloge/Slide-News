<div class="content">

 <?php

 $url = "https://rss.aftonbladet.se/rss2/small/pages/sections/senastenytt/";
 if(isset($_POST['submit'])){
   if($_POST['feedurl'] != ''){
     $url = $_POST['feedurl'];
   }
 }

 $invalidurl = false;
 if(@simplexml_load_file($url)){
  $feeds = simplexml_load_file($url);
 }else{
  $invalidurl = true;
  echo "<h2>Invalid RSS feed URL.</h2>";
 }


 $i=0;
 if(!empty($feeds)){

  $site = $feeds->channel->title;
  $sitelink = $feeds->channel->link;

  echo "<h2>".$site."</h2>";
  foreach ($feeds->channel->item as $item) {

   $title = $item->title;
   $link = $item->link;
   $description = $item->description;
   $postDate = $item->pubDate;
   $pubDate = date('D, d M Y',strtotime($postDate));
   $image = $item->enclosure['url'];


   if($i>=5) break;
  ?>
   <div class="post">
     <div class="post-img">
         <img src="<?php echo $image; ?>" height="150px" width="150px">
     </div>  
     <div class="post-head">
       <h2><?php echo $title; ?></h2>
       <span><?php echo $pubDate; ?></span>
     </div>
     <div class="post-content">
        <?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?>
     </div>
   </div>

   <?php
    $i++;
   }
 }else{
   if(!$invalidurl){
     echo "<h2>No item found</h2>";
   }
 }
 ?>
</div>