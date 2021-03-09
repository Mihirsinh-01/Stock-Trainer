<?php 
    echo "<script>
            var javascriptVar = 'success';
         </script>";
    

    $phpVar = "<script>document.writeln(javascriptVar);</script>";
    echo $phpVar;
?>