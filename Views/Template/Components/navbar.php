<header class=" p-0">
    <div class="bg-color-1">
        <div class="new-contact-navbar d-flex justify-content-between py-2">
            <ul class="social social--white">
                <li><a href="https://web.facebook.com/BuhoMyG" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="https://www.instagram.com/buhos_myg/" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://wa.me/573108714741" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
            </ul>
            <el-link :underline="false" href="<?=base_url()?>/contacto" class="fs-5" type="primary">Estamos encantados de escucharte. Solicite una cotización.</el-link>
        </div>
    </div>
    <div class="bg-color-4 new-info-navbar">
        <div class="bg-color-4 d-flex justify-content-between align-items-center">
            <div class="new-navbar-logo">
                <img src="<?=media()."/images/uploads/".$data['company']['logo']?>" alt="<?=$data['company']['name']?>"/>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center me-4">
                    <i class="fas fa-phone fs-1 me-4 t-color-1"></i>
                    <div class="d-flex flex-column fs-5">
                        <span class="t-color-3">Llámanos ahora!</span>
                        <strong>3124567890</strong>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-envelope fs-1 me-4 t-color-1"></i>
                    <div class="d-flex flex-column fs-5">
                        <span class="t-color-3">Escríbenos ahora</span>
                        <strong>info@gmail.co</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php getComponent("navMobile",$data)?>
</header>
<div class="new-header bg-color-2">
    <div class="mx-11">
        <div class="new-navbar-logo-mobile">
            <img src="<?=media()."/images/uploads/".$data['company']['logo']?>" alt="<?=$data['company']['name']?>"/>
        </div>
        <nav class="new-navbar">
            <el-menu
            :default-active="activeIndex"
            class="el-menu new-navbar-links"
            mode="horizontal"
            :ellipsis="false"
            @select="handleSelect"
            >
                <el-menu-item index="1"><el-link :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link></el-menu-item>
                <el-menu-item index="2"><el-link :underline="false" href="<?=base_url()?>/nosotros" type="primary">Quiénes somos</el-link></el-menu-item>
                <el-sub-menu index="3">
                    <template #title>Servicios</template>
                    <el-menu-item index="3-2">item two</el-menu-item>
                    <el-menu-item index="3-3">item three</el-menu-item>
                    <el-menu-item index="3-1"><el-link :underline="false" href="<?=base_url()?>/servicios/areas" type="primary">Ver todo</el-link></el-menu-item>
                </el-sub-menu>
                <el-menu-item index="4"><el-link :underline="false" href="<?=base_url()?>/blog" type="primary">Blog</el-link></el-menu-item>
                <el-menu-item index="5"><el-link :underline="false" href="<?=base_url()?>/contacto" type="primary">Contacto</el-link></el-menu-item>
                <el-menu-item index="6" class="me-4"><el-link :underline="false" href="<?=base_url()?>/faq" type="primary">FAQ</el-link></el-menu-item>
            </el-menu>
            <el-menu
            :default-active="activeIndex"
            class="el-menu"
            mode="horizontal"
            :ellipsis="false"
            @select="handleSelect"
            >
                <?php if(isset($_SESSION['login'])){ ?>
                <el-sub-menu index="8" class="new-header-item-login">
                    <template #title><i class="fas fa-user"></i></template>
                    <el-menu-item index="8-1">
                        <el-link :underline="false" href="<?=base_url()?>/usuarios/perfil" type="primary">Perfil</el-link>
                    </el-menu-item>
                    <el-menu-item index="8-2" onclick="logout()">Cerrar sesión</el-menu-item>
                </el-sub-menu>
                <?php }else {?>
                    <el-menu-item index="9">
                        <div class="d-flex align-items-center justify-content-center new-header-item-login">
                            <el-button onclick="openLoginModal();" class="btn btn-bg-1" type="primary">Iniciar sesión</el-button>
                        </div>
                    </el-menu-item>
                <?php }?>
                <el-menu-item index="10" id="btnNav">
                    <i class="fas fa-bars"></i>
                </el-menu-item>
            </el-menu>
        </nav>
    </div>
</div>