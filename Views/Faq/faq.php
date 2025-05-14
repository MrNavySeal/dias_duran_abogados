<?php
    headerPage($data);
?>
<?php getComponent("pageCover",$data)?>
<main class="container d-flex justify-content-center my-5">
    <div class="demo-collapse w-100">
        <el-collapse v-model="activeNames">
        <el-collapse-item title="fugiat perspiciatis aspernatur excepturi voluptates exercitationem hic soluta id temporibus, quia corrupti porro! Hic, nesciunt quaera ?" name="1">
            <div>
            Consistent with real life: in line with the process and logic of real
            life, and comply with languages and habits that the users are used to;
            </div>
        </el-collapse-item>
        <el-collapse-item title="fugiat perspiciatis aspernatur excepturi voluptates exercitationem hic soluta id temporibus?" name="2">
            <div>
                Operation feedback: enable the users to clearly perceive their
                operations by style updates and interactive effects;
            </div>
        </el-collapse-item>
        <el-collapse-item title="fugiat perspiciatis aspernatur?" name="3">
            <div>
                Easy to identify: the interface should be straightforward, which helps
                the users to identify and frees them from memorizing and recalling.
            </div>
        </el-collapse-item>
        <el-collapse-item title="fugiat perspiciatis aspernatur excepturi voluptates exercitationem hic soluta id temporibus?" name="4">
            <div>
                Decision making: giving advices about operations is acceptable, but do
                not make decisions for the users;
            </div>
        </el-collapse-item>
        </el-collapse>
    </div>
</main>
<?php
    footerPage($data);
?>