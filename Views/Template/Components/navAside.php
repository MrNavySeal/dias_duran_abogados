<aside class="nav-aside">
  <el-row class="tac">
    <el-col :span="24">
      <el-menu
        default-active="1"
        class="el-menu-vertical-demo"
        @open="handleOpen"
        @close="handleClose"
      >
        <el-sub-menu :index="index" v-for="(data,index) in arrAreas" :key="index">
          <template #title>
            <el-icon><location /></el-icon>
            <span><el-link :underline="false" :href="data.route" type="primary">{{data.name}}</el-link></span>
          </template>
          <el-menu-item-group>
            <el-menu-item :index="index+'-'+indexArea" v-for="(det,indexArea) in data.services" :key="indexArea"><el-link :underline="false" :href="det.route" type="primary">{{det.name}}</el-link></el-menu-item>
          </el-menu-item-group>
        </el-sub-menu>
      </el-menu>
    </el-col>
  </el-row>
</aside>