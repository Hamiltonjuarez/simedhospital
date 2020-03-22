<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siimed</title>
    <style>
            .body{
                margin-top: 15px;

            },

            .titulo{
                 small-caps 100%/200% serif;
            },

            table{
                border-color:black 5px solid;
                width:100%;
            },

            .infoMedico{
                text-align: right;
            },
            .line{
                border: solid 2px blue;
                height: 1px;
                margin-left:50px;
                margin-right:50px;
            },
            .logo img{
                float:left;
            },

            .footer{
                margin-top: 20px;
                text-align: center;
                justify-content: center;
            }

        </style>
</head>
<body>
    <div>
        <table>
            <thead>
                <tr>
                    <h1 class="titulo">RECETA MÉDICA</h1>
                </tr>
            </thead>
        </table>
    </div>
        <div>
                <table >
                        <thead>
                            <tr>
                                    <td width="250px" class="logo">
                                            <img src="{{asset('AdjuntosDoctor/1-Lopez/logosiimed.jpg')}}" alt="" height="150" >
                                    </td>
                                    <td  class="infoMedico">
                                            <strong>FECHA:</strong>  <label for=""> </label><br><br>
                                            <label for="">DR. jose marldonado</label>
                                            <br>
                                            <label for=""><strong>Especialidad: </strong></label>
                                            <label for=""></label><br>
                                    </td>
                            </tr>
                        </thead>
                </table>
            </div><br><br><br><br>
            <br>
            <div>

                <table>
                    <tr>
                    <td><h3>hola mundo</h3></td>
                    </tr>
                    <tr>
                        <td><p>
                                Un texto es una composición de signos codificados en un sistema de escritura que forma una unidad de sentido.

                                También es una composición de caracteres imprimibles (con grafema) generados por un algoritmo de cifrado que, aunque no tienen sentido para cualquier persona, sí puede ser descifrado por su destinatario original. En otras palabras, un texto es un entramado de signos con una intención comunicativa que adquiere sentido en determinado contexto.

                                Las ideas esenciales que comunica un texto están contenidas en lo que se suele denominar «macroproposiciones», unidades estructurales de nivel superior o global, que otorgan coherencia al texto constituyendo su hilo central, el esqueleto estructural que cohesiona elementos lingüísticos formales de alto nivel, como los títulos y subtítulos, la secuencia de párrafos, etc. En contraste, las «microproposiciones» son los elementos coadyuvantes de la cohesión de un texto, pero a nivel más particular o local. Esta distinción fue realizada por Teun van Dijk en 1980.1​

                                El nivel microestructural o local está asociado con el concepto de cohesión. Se refiere a uno de los fenómenos propios de la coherencia, el de las relaciones particulares y locales que se dan entre elementos lingüísticos, tanto los que remiten unos a otros como los que tienen la función de conectar y organizar. También es un conjunto de oraciones agrupadas en párrafos que habla de un tema determinado.</p></td>
                    </tr>
                </table>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <div>
                <table>
                    <thead>
                        <tr>
                            <td><img src="{{asset('AdjuntosDoctor/1-Lopez/firma.jpg')}}" alt="" height="150" ></td>
                            <td>
                                <strong><img src="{{asset('AdjuntosDoctor/1-Lopez/sello.jpg')}}" alt="" height="150" ></strong>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="line"></div>
            <div class="footer">
                <table>
                    <thead>
                        <tr>
                            <td>hola</td>
                        </tr>
                    </thead>
                </table>
            </div>
</body>
</html>
