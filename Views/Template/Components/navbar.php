<nav class="new-navbar container">
    <div class="new-navbar-logo">
        <img src="<?=media()."/images/uploads/".$data['company']['logo']?>" alt="<?=$data['company']['name']?>"/>
    </div>
    <el-menu
    :default-active="activeIndex"
    class="el-menu"
    mode="horizontal"
    :ellipsis="false"
    @select="handleSelect"
    >
    <el-menu-item index="1">Inicio</el-menu-item>
        <el-menu-item index="2">Nosotros</el-menu-item>
        <el-sub-menu index="3">
            <template #title>Servicios</template>
            <el-menu-item index="3-1">item one</el-menu-item>
            <el-menu-item index="3-2">item two</el-menu-item>
            <el-menu-item index="3-3">item three</el-menu-item>
        </el-sub-menu>
        <el-menu-item index="4">Blog</el-menu-item>
        <el-menu-item index="5" class="me-4">Contacto</el-menu-item>
    </el-menu>
    <el-menu
    :default-active="activeIndex"
    class="el-menu"
    mode="horizontal"
    :ellipsis="false"
    @select="handleSelect"
    >
        <el-menu-item index="6"><i class="fas fa-search"></i></el-menu-item>
        <el-menu-item index="7"><i class="fas fa-shopping-cart"></i></el-menu-item>
        <el-sub-menu index="8">
            <template #title><i class="fas fa-user"></i></template>
            <el-menu-item index="8-1">Perfil</el-menu-item>
            <el-menu-item index="8-2">Cerrar sesión</el-menu-item>
        </el-sub-menu>
    </el-menu>
</nav>