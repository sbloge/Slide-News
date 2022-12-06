<html lang="sv">
    <head>
        <link rel="stylesheet" href="css.css">
        <meta charset="utf-8">
    <meta http-equiv="refresh" content="600">
        <title>Bildspel</title>
    </head>
    <body>
        <div class="content">
            <div class="images">
            </div>
        </div>
        <div class="feed">

             <form method="post" action="">
            </form>
            <?php
           
            $url = "https://www.expressen.se/om-expressen/rss-smidigt-satt-att-fa-nyheter-fran-expressen-9/";
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
              $image = $item->enclosure;
              $link = $item->link;
              $description = $item->description;
              $postDate = $item->pubDate;
              $pubDate = date('D, d M Y',strtotime($postDate));
              
           
              if($i>=6) break;
             ?>
              <div class="post">
                <div class="post-img">
                  <img src="<?php echo $image['url']; ?>" height="150px" width="150px">
                </div>
                <div class="info">
                  <div class="post-head">
                    <h2><?php echo $title; ?></h2>
                    <span><?php echo $pubDate; ?></span>
                  </div>
                  <div class="post-content">
                    <?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?>
                  </div>
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
        <script src="Slide.js"></script>
    </body>
</html>