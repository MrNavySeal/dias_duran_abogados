<header class="new-header p-0 bg-color-2 d-flex justify-content-between">
    <div class="container">
        <nav class="new-navbar ">
            <div class="new-navbar-logo">
                <img src="<?=media()."/images/uploads/".$data['company']['logo']?>" alt="<?=$data['company']['name']?>"/>
            </div>
            <el-menu
            :default-active="activeIndex"
            class="el-menu new-navbar-links"
            mode="horizontal"
            :ellipsis="false"
            @select="handleSelect"
            >
            <el-menu-item index="1"><el-link :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link></el-menu-item>
                <el-menu-item index="2"><el-link :underline="false" href="<?=base_url()?>/nosotros" type="primary">Nosotros</el-link></el-menu-item>
                <el-sub-menu index="3">
                    <template #title>Servicios</template>
                    <el-menu-item index="3-1">Item one</el-menu-item>
                    <el-menu-item index="3-2">item two</el-menu-item>
                    <el-menu-item index="3-3">item three</el-menu-item>
                </el-sub-menu>
                <el-menu-item index="4"><el-link :underline="false" href="<?=base_url()?>/blog" type="primary">Blog</el-link></el-menu-item>
                <el-menu-item index="5" class="me-4"><el-link :underline="false" href="<?=base_url()?>/contacto" type="primary">Contacto</el-link></el-menu-item>
            </el-menu>
            <el-menu
            :default-active="activeIndex"
            class="el-menu"
            mode="horizontal"
            :ellipsis="false"
            @select="handleSelect"
            >
                <el-menu-item index="6" id="btnSearch"><i class="fas fa-search"></i></el-menu-item>
                <el-menu-item index="7" id="btnCart">
                    <span id="qtyCart"><?=$qtyCart?></span>
                    <i class="fas fa-shopping-cart"></i>
                </el-menu-item>
                <?php if(isset($_SESSION['login'])){ ?>
                <el-sub-menu index="8" class="new-header-item-login">
                    <template #title><i class="fas fa-user"></i></template>
                    <el-menu-item index="8-1">
                        <el-link :underline="false" href="<?=base_url()?>/usuarios/perfil" type="primary">Perfil</el-link>
                    </el-menu-item>
                    <el-menu-item index="8-2" onclick="logout()">Cerrar sesión</el-menu-item>
                </el-sub-menu>
                <?php }else {?>
                    <div class="d-flex align-items-center justify-content-center new-header-item-login">
                        <el-button onclick="openLoginModal();" class="btn btn-bg-1" type="primary">Iniciar sesión</el-button>
                    </div>
                <?php }?>
                <el-menu-item index="9" id="btnNav">
                    <i class="fas fa-bars"></i>
                </el-menu-item>
            </el-menu>
        </nav>
    </div>
    <?php getComponent("search",$data)?>
    <?php getComponent("cartBar",$data)?>
    <?php getComponent("navMobile",$data)?>
</header>