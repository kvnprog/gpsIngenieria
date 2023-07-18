<?php

use Dompdf\Dompdf;

require('../../vendor/autoload.php');

$pdf=new Dompdf();

$cadenaHTML = "";

$cadenaHTML = $cadenaHTML."<style>

.empty-row {
    height: 0;
    border: none;
  }
table {
  border-collapse: collapse; /* Combina los bordes adyacentes */
  width: 100%;
}

th, td {
  border: 1px solid black; /* Agrega un borde sólido de 1 píxel */
  padding: 1px; /* Espacio interno para el contenido */
  text-align: left; /* Alinea el texto a la izquierda */
}

.tdtitulo{
    background-color: #89ac76;
    font-weight: bold;
}

.tdfolio{
    color: #CB3234;
    font-weight: bold; 
}

td{
    text-align: center;
    font-size: 14px;
}


</style>";


$cadenaHTML = $cadenaHTML."<table class=\"table table-bordered\" style=\"font-size:10px;\">";
//     <!-- primera estructura col 1 a 4 -->
$cadenaHTML = $cadenaHTML."<tr>
         <td  rowspan=\"4\"  colspan=\"6\">1 1-4</td>
         <td  rowspan=\"2\" class=\"tdtitulo\"  colspan=\"2\">ENVIOS</td>
         <td  rowspan=\"2\" class=\"tdtitulo\">ORDEN NO</td>
         <td  rowspan=\"2\" class=\"tdfolio\">NO.FOLIO</td>
         <td   class=\"empty-row \"></td>
     </tr>
     
     <tr></tr>
     
     ";
    //  //row 2
     $cadenaHTML = $cadenaHTML. "<tr>
             <td   colspan=\"2\">Paqueteria</td>
             <td colspan=\"1\">Fecha:</td>
             <td colspan=\"1\"></td>
             <td   class=\"empty-row \"></td>
         </tr>";
      
    //      //row 3
         $cadenaHTML = $cadenaHTML."<tr>
             <td style=\"width: 25%;\" colspan=\"2\">Rastreo:</td>
             <td rowspan=\"2\" colspan=\"2\">Recibido Por:</td>
             <td   class=\"empty-row \"></td>
         </tr>";
    //      //row 4
         $cadenaHTML = $cadenaHTML."<tr>
             <td  style=\"width: 50%;\" colspan=\"6\">Cliente/Empresa:</td>
             <td colspan=\"2\" >accesorios:</td>
              <td   class=\"empty-row \"></td>
             
         </tr>";
       

    //      //     <!-- primera estructura final-->


    //     //  <!-- primera estructura row 5-->
        $cadenaHTML = $cadenaHTML."<tr>
                 <td style=\"width: 50%;\" colspan=\"6\">Domicilio:</td>
                 <td style=\"width: 25%;\" colspan=\"2\"></td>
                 <td>Modelo:</td>
                 <td></td>
                  <td   class=\"empty-row \"></td>
             </tr>"; 
    //      //     <!-- primera estructura col 5 final -->


    //       //     <!-- primera estructura col 6-->
          $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"6\"></td>
                <td  colspan=\"2\"></td>
                <td>Descripcion:</td>
                <td></td>
                <td   class=\"empty-row \"></td>
             </tr>";
    //     //     <!-- primera estructura col 6 final -->

    //     //     <!-- primera estructura col 7-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"3\"> Ciudad,Estado y CP:</td>

                <td  colspan=\"3\"> RFC:</td>
                <td  colspan=\"2\"></td>

                <td colspan=\"2\">No.De Serie:</td>
                <td   class=\"empty-row \"></td>
            </tr>"; 
    //     //     <!-- primera estructura col 7 final -->

    //     //     <!-- primera estructura col 8-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"3\"> Contacto:</td>

                <td  colspan=\"3\"> e-mail:</td>

                <td  colspan=\"2\"></td>

                <td colspan=\"2\"></td>
                 <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 8 final -->

    //     //     <!-- primera estructura col 9-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td  colspan=\"2\" class=\"tdtitulo\">Trabajo Realizado</td>
                <td   class=\"empty-row \"></td>

            </tr>";
    //     //     <!-- primera estructura col 9 final -->


    //     //     <!-- primera estructura col 10-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 75%;\" colspan=\"8\"></td>
                <td>Demostracion</td>
                <td></td>
                <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 10 final -->

    //     //     <!-- primera estructura col 11-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td>Instalacion</td>
                <td></td>
                <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 11 final -->


    //     //     <!-- primera estructura col 12-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td>Servicio</td>
                <td></td>
                <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 12 final -->


    //     //     <!-- primera estructura col 13-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"> Trabajo Realizado :</td>
                <td>Garantia</td>
                <td></td>
                <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 13 final -->


    //     //     <!-- primera estructura col 14-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td>Reparacion</td>
                <td></td>
                <td   class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 14 final -->


    //     //     <!-- primera estructura col 15-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td colspan=\"2\" class=\"tdtitulo\">Vo.Bo</td>
                <td  class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 15 final -->


    //     //     <!-- primera estructura col 16-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                <td colspan=\"2\" rowspan=\"6\"></td>
                <td  rowspan=\"6\"  class=\"empty-row \"></td>
            </tr>";
    //     //     <!-- primera estructura col 16 final -->

    //     //     <!-- primera estructura col 17-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\"></td>
                
            </tr>";
    //     //     <!-- primera estructura col 17 final -->

    //        // <!-- primera estructura col 18-->
    // $cadenaHTML = $cadenaHTML."<tr>
    //             <td  colspan=\"8\"></td>
                
    //  </tr>";
    //     //     <!-- primera estructura col 18 final -->





    //     //     <!-- primera estructura col 19-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td  colspan=\"8\">Comentarios:</td>
        </tr>";
    //     //     <!-- primera estructura col 19 final -->

     //     //     <!-- primera estructura col 19-->
     $cadenaHTML = $cadenaHTML."<tr>
     <td  colspan=\"8\"></td>
</tr>";
//     //     <!-- primera estructura col 19 final -->


    //     //     <!-- primera estructura col 20-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td class=\"tdtitulo\"  colspan=\"2\">No.De Parte</td>
                <td class=\"tdtitulo\" colspan=\"3\">Descripcion</td>
                <td class=\"tdtitulo\" colspan=\"1\">Cant.</td>
                <td class=\"tdtitulo\" colspan=\"1\">precio</td>
                <td class=\"tdtitulo\" colspan=\"1\">Total</td>
            </tr>";
    //     //     <!-- primera estructura col 20 final -->


    //     //     <!-- primera estructura col 21-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 25%;\" colspan=\"3\"></td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
            </tr>";
    //     //     <!-- primera estructura col 21 final -->


    //     //     <!-- primera estructura col 22-->
        // $cadenaHTML = $cadenaHTML."<tr>
        //         <td style=\"width: 20%;\" colspan=\"2\">algo</td>
        //         <td style=\"width: 25%;\" colspan=\"3\">algo</td>
        //         <td style=\"width: 5%;\" colspan=\"1\">algo</td>
        //         <td colspan=\"1\">algo</td>
        //         <td colspan=\"1\">algo</td>
        //         <td colspan=\"2\" rowspan=\"6\">algo</td>
        //     </tr>";
        // $cadenaHTML = $cadenaHTML."<tr>
        //         <td style=\"width: 20%;\" colspan=\"2\">algo</td>
        //         <td style=\"width: 25%;\" colspan=\"3\">algo</td>
        //         <td style=\"width: 5%;\" colspan=\"1\">algo</td>
        //         <td colspan=\"1\">algo</td>
        //         <td colspan=\"1\">algo</td>
               
        //     </tr>";
    // //     //     <!-- primera estructura col 22 final -->

    // //     // //     <!-- primera estructura col 23-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 25%;\" colspan=\"3\"></td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"2\" rowspan=\"6\"></td>
                <td  class=\"empty-row \" rowspan=\"6\"></td>
             </tr>";
    // //     // //     <!-- primera estructura col 23 final -->

    // //     //     <!-- primera estructura col 24-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 20%;\" colspan=\"2\">algo</td>
                <td style=\"width: 25%;\" colspan=\"3\">algo</td>
                <td style=\"width: 5%;\" colspan=\"1\">algo</td>
                <td colspan=\"1\">algo</td>
                <td colspan=\"1\">algo</td>

            </tr>";
    // //     //     <!-- primera estructura col 24 final -->

    // //     //     <!-- primera estructura col 25-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 25%;\" colspan=\"3\"></td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>

            </tr>";
    //     //     <!-- primera estructura col 25 final -->

    //     //     <!-- primera estructura col 26-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 25%;\" colspan=\"3\"></td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
            </tr>";
    //     //     <!-- primera estructura col 26 final -->

    //     //     <!-- primera estructura col 27-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 30%;\" class=\"tdtitulo\" colspan=\"4\">Garantias</td>
                <td style=\"width: 15%;\" colspan=\"1\">Calibracion</td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>

            </tr>";
    //     //     <!-- primera estructura col 27 final -->


    //     // //     <!-- primera estructura col 28-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 10%;\" colspan=\"2\"></td>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 15%;\" colspan=\"1\">Mano de Obra</td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                
            </tr>";
        //     $cadenaHTML = $cadenaHTML."<tr>
        //     <td style=\"width: 10%;\" colspan=\"2\">algo</td>
        //     <td style=\"width: 20%;\" colspan=\"2\">algo</td>
        //     <td style=\"width: 15%;\" colspan=\"1\">algo</td>
        //     <td style=\"width: 5%;\" colspan=\"1\">algo</td>
        //     <td colspan=\"1\">algo</td>
        //     <td colspan=\"1\">algo</td>
        //     <td colspan=\"2\" rowspan=\"7\">algo</td>
        // </tr>";
    //     //     // <!-- primera estructura col 28 final -->

    //     //     <!-- primera estructura col 29-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 10%;\" colspan=\"2\"></td>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 15%;\" colspan=\"1\">Horas de Viaje</td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"2\" rowspan=\"7\"></td>
                <td  class=\"empty-row \" colspan=\"2\" rowspan=\"7\"></td>

             </tr>";
    //     // //     <!-- primera estructura col 29 final -->

    //     //     <!-- primera estructura col 30-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 10%;\" colspan=\"2\"></td>
                <td style=\"width: 20%;\" colspan=\"2\"></td>
                <td style=\"width: 15%;\" colspan=\"1\">Kilometraje</td>
                <td style=\"width: 5%;\" colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>

            </tr>";
    //         //<!-- primera estructura col 30 final -->

    //     //     <!-- primera estructura col 31-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td style=\"width: 30%;\" class=\"tdtitulo\" colspan=\"3\">Prestamo Equipo</td>
                <td style=\"width: 20%;\" class=\"tdtitulo\" colspan=\"3\">Cobranza</td>

                <td colspan=\"1\">Sub Total</td>
                <td colspan=\"1\"></td>

            </tr>";
    //     //     <!-- primera estructura col 31 final -->

    //     //     <!-- primera estructura col 32-->
            $cadenaHTML = $cadenaHTML."<tr>
                <td colspan=\"1\">No.parte</td>
                <td colspan=\"1\">No.Serie</td>
                <td colspan=\"1\">Descripcion</td>
                <td style=\"width: 20%;\" colspan=\"3\">Factura No:</td>

                <td colspan=\"1\">Flete</td>
                <td colspan=\"1\"></td>

    //         </tr>";
    //     //     <!-- primera estructura col 32 final -->
    //     //     <!-- primera estructura col 33-->
        $cadenaHTML = $cadenaHTML."<tr>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td colspan=\"1\"></td>
                <td style=\"width: 20%;\" colspan=\"3\">Fecha de Pago:</td>

                <td colspan=\"1\" >I.V.A</td>
                <td colspan=\"1\" ></td>

            </tr>";
    //     //     <!-- primera estructura col 33 final -->
    //     //     <!-- primera estructura col 34-->
    $cadenaHTML = $cadenaHTML."<tr>
    <td colspan=\"1\"></td>
    <td colspan=\"1\"></td>
    <td colspan=\"1\"></td>
    <td style=\"width: 20%;\" colspan=\"3\">Metodo de Pago:</td>

    <td colspan=\"1\" rowspan=\"2\" >TOTAL</td>
    <td colspan=\"1\"rowspan=\"2\"></td>

     </tr>";
        //     <!-- primera estructura col 34 final -->


        //     //     <!-- primera estructura col 35-->
    $cadenaHTML = $cadenaHTML."<tr>
    <td colspan=\"1\"></td>
    <td colspan=\"1\"></td>
    <td colspan=\"1\"></td>
    <td style=\"width: 20%;\" colspan=\"3\">Importe:</td>

   

     </tr>";
        //     <!-- primera estructura col 35 final -->



$cadenaHTML = $cadenaHTML."</table>";

// Le pasamos el html a dompdf
$pdf->loadHtml($cadenaHTML);
// Colocamos als propiedades de la hoja
$pdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$pdf->render();

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");

// Ponemos el PDF en el browser
echo $pdf->output();












        // <!-- <table class=" table table-bordered" style="font-size:10px;"> -->

        //     <!-- primera estructura col 1 a 4 -->
        //     <!-- <tr style="height: 10px;">
        //         <td rowspan="4" style="width: 50%;" colspan="6">algo</td>
        //         <td style="width: 25%;" colspan="2">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>
        //     </tr>
        //     <tr>
        //         <td style="width: 25%;" colspan="2">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>
        //     </tr>
        //     <tr>
        //         <td style="width: 25%;" colspan="2">algo</td>
        //         <td rowspan="2" colspan="2">algo</td>
        //     </tr>
        //     <tr>
        //         <td>algo</td>
        //     </tr> -->
        //     <!-- primera estructura final-->

        //     <!-- primera estructura col 5-->
        //     <!-- <tr>
        //         <td style="width: 50%;" colspan="6">algo</td>
        //         <td style="width: 25%;" colspan="2"></td>
        //         <td>algo</td>
        //         <td>algo</td>
        //     </tr> -->
        //     <!-- primera estructura col 5 final -->

        //     <!-- primera estructura col 6-->
        //     <!-- <tr>
        //         <td style="width: 50%;" colspan="6">algo</td>
        //         <td style="width: 25%;" colspan="2"></td>
        //         <td>algo</td>
        //         <td>algo</td>
        //     </tr> -->
        //     <!-- primera estructura col 6 final -->

        //     <!-- primera estructura col 7-->
        //     <!-- <tr>
        //         <td style="width: 25%;" colspan="3"> algo</td>

        //         <td style="width: 25%;" colspan="3"> algo</td>
        //         <td style="width: 25%;" colspan="2"></td>

        //         <td colspan="2">algo</td>
        //     </tr> -->
        //     <!-- primera estructura col 7 final -->

        //     <!-- primera estructura col 8-->
        //     <tr>
        //         <td style="width: 25%;" colspan="3"> algo</td>

        //         <td style="width: 25%;" colspan="3"> algo</td>

        //         <td style="width: 25%;" colspan="2"></td>

        //         <td colspan="2">algo</td>
        //     </tr>
        //     <!-- primera estructura col 8 final -->

        //     <!-- primera estructura col 9-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td style="width: 25%;" colspan="2">algo</td>

        //     </tr>
        //     <!-- primera estructura col 9 final -->


        //     <!-- primera estructura col 10-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>

        //     </tr>
        //     <!-- primera estructura col 10 final -->

        //     <!-- primera estructura col 11-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>

        //     </tr>
        //     <!-- primera estructura col 11 final -->


        //     <!-- primera estructura col 12-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>

        //     </tr>
        //     <!-- primera estructura col 12 final -->


        //     <!-- primera estructura col 13-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>

        //     </tr>
        //     <!-- primera estructura col 13 final -->


        //     <!-- primera estructura col 14-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td>algo</td>
        //         <td>algo</td>

        //     </tr>
        //     <!-- primera estructura col 14 final -->


        //     <!-- primera estructura col 15-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td colspan="2">algo</td>


        //     </tr>
        //     <!-- primera estructura col 15 final -->


        //     <!-- primera estructura col 16-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>
        //         <td colspan="2" rowspan="6">algo</td>


        //     </tr>
        //     <!-- primera estructura col 16 final -->

        //     <!-- primera estructura col 17-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>



        //     </tr>
        //     <!-- primera estructura col 17 final -->

        //     <!-- primera estructura col 18-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>



        //     </tr>
        //     <!-- primera estructura col 18 final -->





        //     <!-- primera estructura col 19-->
        //     <tr>
        //         <td style="width: 75%;" colspan="8">algo</td>



        //     </tr>
        //     <!-- primera estructura col 19 final -->


        //     <!-- primera estructura col 20-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //     </tr>
        //     <!-- primera estructura col 20 final -->


        //     <!-- primera estructura col 21-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>


        //     </tr>
        //     <!-- primera estructura col 21 final -->


        //     <!-- primera estructura col 22-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="2" rowspan="6">algo</td>
        //     </tr>
        //     <!-- primera estructura col 22 final -->

        //     <!-- primera estructura col 23-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 23 final -->

        //     <!-- primera estructura col 24-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 24 final -->

        //     <!-- primera estructura col 25-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 25 final -->

        //     <!-- primera estructura col 26-->
        //     <tr>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 25%;" colspan="3">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 26 final -->

        //     <!-- primera estructura col 27-->
        //     <tr>
        //         <td style="width: 30%;" colspan="4">garantia</td>
        //         <td style="width: 15%;" colspan="1">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 27 final -->


        //     <!-- primera estructura col 28-->
        //     <tr>
        //         <td style="width: 10%;" colspan="2">algo</td>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 15%;" colspan="1">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="2" rowspan="7">algo</td>

        //     </tr>
        //     <!-- primera estructura col 28 final -->

        //     <!-- primera estructura col 29-->
        //     <tr>
        //         <td style="width: 10%;" colspan="2">algo</td>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 15%;" colspan="1">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 29 final -->

        //     <!-- primera estructura col 30-->
        //     <tr>
        //         <td style="width: 10%;" colspan="2">algo</td>
        //         <td style="width: 20%;" colspan="2">algo</td>
        //         <td style="width: 15%;" colspan="1">algo</td>
        //         <td style="width: 5%;" colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 30 final -->

        //     <!-- primera estructura col 31-->
        //     <tr>
        //         <td style="width: 30%;" colspan="3">prestamo equipo</td>
        //         <td style="width: 20%;" colspan="3">algo</td>

        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 31 final -->

        //     <!-- primera estructura col 32-->
        //     <tr>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td style="width: 20%;" colspan="3">algo</td>

        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>

        //     </tr>
        //     <!-- primera estructura col 32 final -->
        //     <!-- primera estructura col 33-->
        //     <tr>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td style="width: 20%;" colspan="3">algo</td>

        //         <td colspan="1" rowspan="2">algo</td>
        //         <td colspan="1" rowspan="2">algo</td>

        //     </tr>
        //     <!-- primera estructura col 33 final -->
        //     <!-- primera estructura col 34-->
        //     <tr>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td colspan="1">algo</td>
        //         <td style="width: 20%;" colspan="3">algo</td>



        //     </tr>
        //     <!-- primera estructura col 34 final -->






        // </table>
