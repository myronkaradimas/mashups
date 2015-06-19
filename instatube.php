<?php

$clave="128d96b790704f5db73b5a3dc706831a"; //importante cambiarla!



//recoger parámetro por la url
$tag=$_POST['choice'];

if(isset($_GET['tag'])){
	$tag=$_GET['tag'];
}else{
	
}

//harce la llamada a la api
$uri="https://api.instagram.com/v1/tags/".$tag."/media/recent?count=33&client_id=".$clave;
$data=file_get_contents($uri);
$object = json_decode( $data ); // stdClass object

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>

var word = "<?php echo $tag?>";


var url="https://www.googleapis.com/youtube/v3/search?part=snippet&q="+word+"&maxResults=20&key=AIzaSyCDSUsNu8Xdp6dL95Qnu62seqaq8Hzgkl8";

  $(document).ready( function(){

    $.getJSON(url,
      function(data){

        console.log(data);

        $.each(data.items, function(i,item){

          var id=item.id.videoId;


          $('#resultados').append(
            //"<img src='"+item.snippet.thumbnails.medium.url+"'>"+
            "<iframe width='420' height='315' src='https://www.youtube.com/embed/"+id+"?showinfo=0 &iv_load_policy=3&controls= 0&' frameborder='0' allowfullscreen></iframe>" +
            "<li><b>Title:</b> "+item.snippet.title+ 
            "<li><b>Channel Title:</b> "+item.snippet.channelTitle+
            "<li><b>Published at:</b> "+item.snippet.publishedAt+ "<br><br><br>"
            );


        });
      });
  });


</script>
</head>
<body>

<!-- Instagram images style -->

  <style>img{ height: 300px; float: left; }</style>




</head>
<body>

<div id="header">

  <form action="instatube.php" method="post" enctype="multipart/form-data">

      <table id="sample">

        <tr>
          <td><a href="homepage.html">
            <img src="images/logopeq.png" class="logo"></a>
          </td>
          <td><input type="text" name="choice" class="search"></td>
          <td><input type="submit" class="button" value="Buscar"></td>
        </tr>
      
      </table>

  </form>

</div>
 

<div id="images">
  <?php //bucle con los datos

  foreach($object->data as $item):
  ?>
  <img src='<?= $item->images->standard_resolution->url?>'/>
  <?php
  endforeach;
  ?>
  
</div>


<br>

<!--  Youtube videos   -->

  <div id="resultados"></div>



</body>
</html>


<?php
?>
