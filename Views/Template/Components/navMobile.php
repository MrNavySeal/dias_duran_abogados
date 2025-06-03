<div class="navmobile">
    <div class="navmobile--mask"></div>
    <div class="navmobile--elements">
        <div class="navmobile--header">
            <div class="navmobile--title">
                <img src="<?=media()."/images/uploads/".$data['company']['logo']?>" alt="<?=$data['company']['name']?>"/>
            </div>
            <span id="closeNav" class="t-color-2"><i class="fas fa-times"></i></span>
        </div>
        <ul class="navmobile-links">
            <li class="navmobile-link"><a href="<?=base_url()?>"><strong class="fs-5">Inicio</strong></a></li>
            <li class="navmobile-link"><a href="<?=base_url()?>/nosotros"><strong class="fs-5">Nosotros</strong></a></li>
            <div class="navmobile-link accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingServices">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
                        <strong class="fs-5">Áreas de asesoría</strong>
                    </button>
                    </h2>
                    <div id="collapseServices" class="accordion-collapse collapse" aria-labelledby="headingServices" data-bs-parent="#accordionServices">
                        <div class="accordion-body">
                            <ul>
                                <li class="navmobile-link" v-for="(data,index) in arrAreas" :key="index"><a :href="data.route">{{data.name}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <li class="navmobile-link"><a href="<?=base_url()?>/blog"><strong class="fs-5">Blog</strong></a></li>
            <li class="navmobile-link"><a href="<?=base_url()?>/contacto"><strong class="fs-5">Contacto</strong></a></li>
            <?php if(!isset($_SESSION['login'])){ ?>
            <li class="navmobile-link" onclick="openLoginModal();"><strong class="fs-5">Iniciar sesión</strong></li>
            <?php } else {?>
            <div class="navmobile-link accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingProfile">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                        <strong class="fs-5">Perfil</strong>
                    </button>
                    </h2>
                    <div id="collapseProfile" class="accordion-collapse collapse" aria-labelledby="headingProfile" data-bs-parent="#accordionProfile">
                        <div class="accordion-body">
                            <ul>
                                <li class="navmobile-link"><a href="<?=base_url()."/usuarios/perfil"?>">Ver perfil</a></li>
                                <li class="navmobile-link c-p" onclick="logout()">Cerrar sesión</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </ul>
    </div>
</div>