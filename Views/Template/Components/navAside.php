<aside class="nav-aside">
  <el-row class="tac">
    <el-col :span="24">
      <el-menu
        default-active="1"
        class="el-menu-vertical-demo"
        @open="handleOpen"
        @close="handleClose"
      >
        <el-sub-menu index="1">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>/servicios/area" type="primary">Derecho Tributario y Planeación Fiscal</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="1-1"><el-link :underline="false" href="<?=base_url()?>/servicios/servicio" type="primary">Optimización fiscal para personas y empresas</el-link></el-menu-item>
            <el-menu-item index="1-2"><el-link :underline="false" href="<?=base_url()?>/servicios/servicio" type="primary">Defensa en procesos fiscales ante la DIAN y entidades territoriales</el-link></el-menu-item>
            <el-menu-item index="1-3"><el-link :underline="false" href="<?=base_url()?>/servicios/servicio" type="primary">Estructuración fiscal para inversiones y transacciones</el-link></el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="2">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Derecho de Familia</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="2-1">Planificación patrimonial con herramientas legales avanzadas</el-menu-item>
            <el-menu-item index="2-2">Trámite de sucesiones para proteger el legado familiar</el-menu-item>
            <el-menu-item index="2-3">Divorcios, capitulaciones y separación de bienes con enfoque financiero</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="3">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Derecho Laboral, Seguridad Social y Seguridad en el Trabajo</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="3-1">Asesoría en contratación, terminación de contratos, indemnizaciones y conflictos laborales</el-menu-item>
            <el-menu-item index="3-2">Gestión y reclamación de pensiones, incluyendo pensiones especiales y complejas</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="4">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Derecho Administrativo y Contratación Estatal</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="4-1">Representación en litigios administrativos y contractuales contra entidades públicas</el-menu-item>
            <el-menu-item index="4-2">Asesoría para empresas en procesos de contratación con el Estado</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="5">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Derecho Disciplinario</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="5-1">Defensa ante la Procuraduría, personerías y entidades de control</el-menu-item>
            <el-menu-item index="5-2">Asesoría preventiva para funcionarios públicos y profesionales sujetos a control disciplinario</el-menu-item>
            <el-menu-item index="5-3">Impugnación de sanciones y formulación de estrategias de defensa</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="6">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Derecho Inmobiliario y Avalúos</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="6-1">Asesoría en compra y venta de inmuebles, estudios de títulos y saneamiento jurídico 	</el-menu-item>
            <el-menu-item index="6-2">Trámites urbanísticos, englobes, desenglobes y asuntos de propiedad horizontal</el-menu-item>
            <el-menu-item index="6-3">Avalúos inmobiliarios y representación en procesos judiciales y extrajudiciales</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
        <el-sub-menu index="7">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" href="<?=base_url()?>" type="primary">Servicios Notariales y Legalización de Documentos</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="7-1">Elaboración y formalización de testamentos, contratos, poderes, sucesiones, divorcios, y liquidaciones patrimoniales</el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
      </el-menu>
    </el-col>
  </el-row>
</aside>