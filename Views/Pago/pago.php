<?php
    headerPage($data);
    $arrOrden = $data['data'];
    $arrCliente = $arrOrden['cliente'];
    $arrServicio = $arrOrden['servicio'];
    $strLlave = getCredentials()['client'];
?>
<?php getComponent("pageCover",$data)?>
<script src="https://www.paypal.com/sdk/js?client-id=<?=$strLlave?>&currency=<?=$arrOrden['currency']?>&locale=es_ES"></script>
<input type="hidden" value = "<?=$data['id_encrypt']?>" id="idOrder">
<main class="container my-5">
    <div class="row">
        <div class="col-md-8 mb-4">
            <h2 class="t-color-2 mb-4">Detalles de facturación</h2>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Nombre</td>
                            <td><?=$arrCliente['firstname']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Apellido</td>
                            <td><?=$arrCliente['lastname']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Tipo documento</td>
                            <td><?=$arrCliente['tipo_documento']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">No. documento</td>
                            <td><?=$arrCliente['identification']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Correo</td>
                            <td><?=$arrCliente['email']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Teléfono</td>
                            <td><?=$arrCliente['telefono']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Dirección</td>
                            <td><?=$arrCliente['pais']."/".$arrCliente['departamento']."/".$arrCliente['ciudad']."/".$arrCliente['address'];?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Concepto</td>
                            <td><?=$arrServicio['servicio']?></td>
                        </tr>
                        <tr>
                            <td class="w-25 bg-color-2 t-color-4">Total a pagar</td>
                            <td><?=$arrOrden['currency']." ".formatNum($arrOrden['total'])?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <h2 class="t-color-2 mb-4">Métodos de pago</h2>
            <div id="paypal-button-container"></div>
        </div>
    </div>
</main>
<?php footerPage($data); ?>