<?php
    headerPage($data);
?>
<?php getComponent("pageCover",$data)?>
<main class="container d-flex justify-content-center my-5">
    <div class="demo-collapse w-100">
        <el-collapse v-model="activeNames">
            <el-collapse-item v-for="(data,index) in arrFaq" :key="index" :title="data.question" :name="index">
                <div>{{data.answer}}</div>
            </el-collapse-item>
        </el-collapse>
    </div>
</main>
<?php
    footerPage($data);
?>