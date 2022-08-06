
<script type="text/javascript">
        // Este evendo é acionado após o carregamento da página
        jQuery(window).load(function() {
            //Após a leitura da pagina o evento fadeOut do loader é acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
            jQuery("#loader").delay(2000).fadeOut("slow");
        });
    </script>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>PÁGINA LOAD</title>
    <link rel="stylesheet" href="css/style.css" media="screen"/>
    <script src="/docs/js/jquery-2.1.3.js"></script>
</head>
<body>
    <div id="container">
        <div id="loader"></div>
        <div id="content">
            
        </div>
    </div>
</body>
</html>

<script src="docs/js/jquery.min.js"></script>
  <script src="external.js"></script>
  <script type='text/javascript'>
</script>



<button class="less">-</button>
<input type="number" id="level" name="quantity" min="1" max="5" >
<button class="more">+</button>

<script>
    $(document).ready(function(){
    //desabilita o input de nivel
    $( "#level" ).prop( "disabled", true );
    var nivel = 0;
    $(".more").on('click', function(){  
          nivel++; 
    		  $("#level").val(nivel);    
    });
    
    $(".less").on('click', function(){  
          nivel--; 
    		  $("#level").val(nivel);    
    });
    
});

</script>

