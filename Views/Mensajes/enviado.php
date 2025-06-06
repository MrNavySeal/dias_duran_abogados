<?php headerAdmin($data); ?>
<div id="modalItem"></div>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <?php getComponent("buttonsAdmin",$data);?>
    <h2 class="fs-5"><strong>Asunto: </strong><?=$data['message']['subject']?></h2>
    <div class="d-flex justify-content-between flex-wrap">
        <p class="m-0"><strong>Para: </strong><?=$data['message']['email']?></p>
        <p class="m-0"><?=$data['message']['date']?></p>
    </div>
    <hr>
    <label for="" class="fw-bold">Mensaje:</label>
    <p><?=$data['message']['message']?></p>
    <hr>
</div> 
<?php footerAdmin($data)?>        