<?php
    echo'
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-message-html").click(function () {
                swal({
                    title: "HTML <small>Title</small>!",
                    text: "A custom <span style="color:#F8BB86">html<span> message.",
                    html: true
                });
            });

            $(".btn-message-html1").click(function () {
                swal({
                    title: "HTML <small>Title</small>!",
                    text: "A custom <span style="color:#F8BB86">html<span> message.",
                    html: true
                });
            });

            $(".btn-message-html2").click(function () {
                swal({
                    title: "Soy yo xD",
                    text: "<div class="row"><div class="col s12"><p>Encuentra la idea (causa) en un texto que no lo dice de manera explícita; se infiere de una serie de ideas elaboradas a lo largo del caso para integrarlas en un todo</p></div></div><div class="row"><div class="col s12"><table><thead><tr><th>Nivel 0:No aceptable</th><th>Nivel 1:Básico</th><th>Nivel 2:Competente</th><th>Nivel 3:Sobresaliente</th></tr></thead><tbody><tr><th>El sustentante se limita a describir o parafrasear el caso, sin identificar alguna causa concreta; o a describir consecuencias en vez de causas</th><th>El sustentante plantea causas que no son claras, que no corresponden a los expuestos en el caso o materiales o que se contradicen entre sí</th><th>Plantea claramente una o varias causas interrelacionadas entre sí, pero se refieren a causas evidentes, por ejemplo:<li>El uso del celular</li><li>Falta de maestros a la escuela</li><li>Falta del seguimiento de protocolos para los módulos libres</li></th><th>Plantea claramente una o varias causas interrelacionadas entre sí, las cuales subyacen a la problemática planteada por ejemplo:<br/>-Administración<br/>-Bullying</th></tr></tbody></table></div></div>",
                    html: true
                });
            });
        });
    </script>
    ';