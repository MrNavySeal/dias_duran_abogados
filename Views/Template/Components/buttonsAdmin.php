<div class="d-flex justify-content-end mb-3">
    <?php if($data['botones']['atras']['mostrar']) { ?>
        <button type="button" class="btn btn-primary mx-1" <?=$data['botones']['atras']['evento']."=".'"'.$data['botones']['atras']['funcion'].'"'?>>Atrás <i class="fas fa-reply"></i></button>
    <?php }?>
    <?php if($data['botones']['buscar']['mostrar']) { ?>
        <button type="button" class="btn btn-primary mx-1" <?=$data['botones']['buscar']['evento']."=".'"'.$data['botones']['buscar']['funcion'].'"'?>>Buscar <i class="fas fa-search"></i></button>
    <?php }?>
    <?php if($data['botones']['duplicar']['mostrar']) { ?>
        <button type="button" class="btn btn-primary mx-1" <?=$data['botones']['duplicar']['evento']."=".'"'.$data['botones']['duplicar']['funcion'].'"'?>>Duplicar ventana <i class="fas fa-window-restore"></i></button>
    <?php }?>
    <?php if($data['botones']['nuevo']['mostrar']) { ?>
        <button type="button" class="btn btn-primary mx-1" <?=$data['botones']['nuevo']['evento']."=".'"'.$data['botones']['nuevo']['funcion'].'"'?>>Nuevo <i class="fas fa-plus"></i></button>
    <?php }?>
    <?php if($data['botones']['guardar']['mostrar']) { ?>
        <button type="button" class="btn btn-primary mx-1" <?=$data['botones']['guardar']['evento']."=".'"'.$data['botones']['guardar']['funcion'].'"'?>>Guardar <i class="fas fa-save"></i></button>
    <?php }?>
</div>