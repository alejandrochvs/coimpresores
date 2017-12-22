<?php

// Call Row_Rendering event
$historial_pagos->Row_Rendering();

// idhistorial_pagos
// usuario
// estado_pago
// ref_venta
// fecha_hora_creacion
// riesgo
// monto_pago
// Call Row_Rendered event

$historial_pagos->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid table-view">
    <tr>
        <td class="ewGridContent">
            <div class="ewGridMiddlePanel">
                <table cellspacing="0" class="ewTable ewTableSeparate">
                    <tbody>
                    <?php if ($historial_pagos->idhistorial_pagos->Visible) { // idhistorial_pagos ?>
                        <tr id="r_idhistorial_pagos">
                            <td class="ewTableHeader"><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->idhistorial_pagos->ViewAttributes() ?>><?php echo $historial_pagos->idhistorial_pagos->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->usuario->Visible) { // usuario ?>
                        <tr id="r_usuario">
                            <td class="ewTableHeader"><?php echo $historial_pagos->usuario->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->usuario->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->estado_pago->Visible) { // estado_pago ?>
                        <tr id="r_estado_pago">
                            <td class="ewTableHeader"><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->estado_pago->ViewAttributes() ?>><?php echo $historial_pagos->estado_pago->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->ref_venta->Visible) { // ref_venta ?>
                        <tr id="r_ref_venta">
                            <td class="ewTableHeader"><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->ref_venta->ViewAttributes() ?>><?php echo $historial_pagos->ref_venta->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->fecha_hora_creacion->Visible) { // fecha_hora_creacion ?>
                        <tr id="r_fecha_hora_creacion">
                            <td class="ewTableHeader"><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->fecha_hora_creacion->ViewAttributes() ?>><?php echo $historial_pagos->fecha_hora_creacion->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->riesgo->Visible) { // riesgo ?>
                        <tr id="r_riesgo">
                            <td class="ewTableHeader"><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->riesgo->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->riesgo->ViewAttributes() ?>><?php echo $historial_pagos->riesgo->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->monto_pago->Visible) { // monto_pago ?>
                        <tr id="r_monto_pago">
                            <td class="ewTableHeader"><?php echo $historial_pagos->monto_pago->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->monto_pago->ViewAttributes() ?>><?php echo $historial_pagos->monto_pago->ListViewValue() ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
</table>
<br>
