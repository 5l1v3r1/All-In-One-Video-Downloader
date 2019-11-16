<?php
////**This file is for languages	
		require ("languages/$Languages_panel.php");
	
?>	

	<!-- js of Chart -->
 
        <script type="text/javascript" src="./assets/js/chartJS/Chart.min.js"></script>

<?php
					echo '<div class="admin_div_graphics_info_wall">';
					echo '<div class="div__Graphics">';
					echo '</div>';
					echo '	<div class="resultados"><canvas id="grafico_Visits"></canvas></div>';
					echo '</div>';
?>		

    <script>
            $(document).ready(mostrarResultados(<?php echo date('Y');?> ));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'process_graphics.php',
                        data:'año='+año,
                        success:function(data){

                            var valores = eval(data);

                            var e   = valores[0];
                            var f   = valores[1];
                            var m   = valores[2];
                            var a   = valores[3];
                            var ma  = valores[4];
                            var j   = valores[5];
                            var jl  = valores[6];
                            var ag  = valores[7];
                            var s   = valores[8];
                            var o   = valores[9];
                            var n   = valores[10];
                            var d   = valores[11];
                                
                            var Datos = {
                                    labels : ['<?php echo $Languages_79;?>', '<?php echo $Languages_80;?>', '<?php echo $Languages_81;?>', '<?php echo $Languages_82;?>', '<?php echo $Languages_83;?>', '<?php echo $Languages_84;?>', '<?php echo $Languages_85;?>', '<?php echo $Languages_86;?>', '<?php echo $Languages_87;?>', '<?php echo $Languages_88;?>', '<?php echo $Languages_89;?>', '<?php echo $Languages_90;?>'],
                                    datasets : [
                                        {	
                                            fillColor : '#6c82d2', //COLOR DE LAS BARRAS
                                            strokeColor : '#6c82d2', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : '#9bacea', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : '#dddddd', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                                         }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico_Visits').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>			